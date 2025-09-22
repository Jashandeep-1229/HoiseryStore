<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ItemDetail;
use App\Models\ManageStock;
use App\Models\Season;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $season = Season::where('status',1)->get();
        return view('admin.item.index',compact('season'));
    }
    public function datatable(Request $request){
        $item = Item::where('is_temp',0);
        if($request->search){
            $item->where('article_name','like','%'.$request->search.'%')
            ->orWhereHas('brand',function($q)use($request){
                $q->where('name','like','%'.$request->search.'%');
            })
            ->orWhereHas('category',function($q)use($request){
                $q->where('name','like','%'.$request->search.'%');
            });
        }
        if($request->season_filter){
            $item->where('season_id',$request->season_filter);
        }
        $item = $item->latest()->paginate($request->value ?? 50);
        return view('admin.item.datatable',compact('item'));
    }
    public function change_status($id){
        $item = Item::find($id);
        if($item){
            $item->status = $item->status == 1 ? 0 : 1;
            $item->save();
            $data = [
                'result' => 1,
                'message' => 'Status Changed Successfully'
            ];
        }
        
        return $data;
    }

    public function add_article(Request $request){
        if($request->brand_id == 0 || $request->category_id == 0){
            return -2;
        }
        $check_article = ItemDetail::where('article_name',$request->article_name)->first();
        if($check_article){
            return -1;
        }
        else{
            $item = Item::where('id',$request->item_id)->first();
            if($item){

            }
            else{
                $item = new Item();
                $item->from = 'Manually';
                $item->from_id = 0;
                $item->article_name = $request->article_name;
                $item->brand_id = $request->brand_id;
                $item->category_id = $request->category_id;
                $item->min_alert = $request->min_alert ?? 5;
                $item->max_alert = $request->max_alert ?? 50;
                $item->save();
            }
            $item_detail = new ItemDetail();
            $item_detail->item_id = $item->id;
            $item_detail->brand_id = $request->brand_id;
            $item_detail->category_id = $request->category_id;
            $item_detail->article_name = $request->article_name;
            $item_detail->save();
        }
        return view('admin.item.add_article',compact('item_detail','item'));
    }
    public function add_more(Request $request){
        $old_detail = ItemDetail::where('id',$request->item_detail_id)->first();
        $item_detail = new ItemDetail();
        $item_detail->item_id = $old_detail->item_id;
        $item_detail->brand_id = $old_detail->brand_id;
        $item_detail->category_id = $old_detail->category_id;
        $item_detail->article_name = $old_detail->article_name;
        $item_detail->save();
        return view('admin.item.add_more',compact('item_detail'));
    }

    public function remove_more(Request $request){
        $item_detail = ItemDetail::find($request->item_detail_id);
        if($item_detail){
            $manage_stock = ManageStock::where('item_detail_id',$request->item_detail_id)->delete();
            $item_detail->delete();
            $data = [
                'result' => 1,
                'message' => 'Removed Successfully',
            ];
        }
        else{
            $data = [
                'result' => -1,
                'message' => ' Something Error',
            ];
        }
        return $data;

    }
    public function remove_article(Request $request){
        $item = Item::find($request->itemId);
        $item_detail = ItemDetail::where('item_id',$item->id ?? 0)->get();
        foreach($item_detail as $detail){
            $detail->delete();
        }
        $manage_stock = ManageStock::where('item_id',$request->itemId)->delete();
        $item->delete();
        $data = [
            'result' => 1,
            'message' => 'Article Removed',
        ];
      
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
        $season = Season::where('status',1)->get();
        return view('admin.item.add_edit',compact('category','brand','season'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('add')){
            $obsIds = [];
            foreach ($request->add as $index => $article) {
                // dd($article);
                $item = Item::find($article['item_id']);
                if(!$item){
                    $item = new Item;
                    $item->from = 'Manually';
                    $item->from_id = 0;
                    $item->article_name = $article['article_name'];
                    $item->brand_id = $request->brand_id;
                    $item->category_id = $request->category_id;
                    $item->season_id = $request->season_id;
                    $item->min_alert = $request->min_alert;
                    $item->max_alert = $request->max_alert;
                    $item->is_temp = 1;
                    $item->save();
                }
                $item->season_id = $request->season_id;
                $item->article_name = $article['article_name'];
                $item->is_temp = 0;
                if (isset($article['image']) && $request->hasFile("add.$index.image")) {
                    $file = $request->file("add.$index.image");
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('uploads'), $filename);
                    $article['image'] = $filename;
                    $item->image = $article['image'] ?? '';
                } else {
                    
                }
               
                $item->update();
                $obsIds[] = $item->id;
                $itemDetail_ids = [];
                $stockIds = [];
                foreach($article['item_detail'] as $detail){
                    // dd($detail['id']);
                    $item_detail = ItemDetail::find($detail['id']);
                    if(!$item_detail){
                        $item_detail = new ItemDetail;
                        $item_detail->article_name = $article['article_name'];
                        $item_detail->brand_id = $request->brand_id;
                        $item_detail->category_id = $request->category_id;
                        $item_detail->save();
                    }
                    $item_detail->size = $detail['size'];
                    // $item_detail->color = $detail['color'];
                    $item_detail->opening_stock = $detail['opening_stock'];
                    $item_detail->season_id = $request->season_id;
                    $item_detail->min_alert = $request->min_alert;
                    $item_detail->max_alert = $request->max_alert;
                    $item_detail->purchase_price = $detail['purchase_price'];
                    $item_detail->selling_price = $detail['selling_price'];
                    $item_detail->quantity = $detail['quantity'];
                    $item_detail->mutha = $detail['mutha'];
                    $item_detail->is_temp = 0;
                    $item_detail->barcode_value = $item_detail->article_name.'-'.$detail['size'];
                    $item_detail->update();

                    $itemDetail_ids[] = $item_detail->id;;
                    if($detail['opening_stock'] > 0 &&  $item_detail->is_temp == 0){
                        $manage_stock = ManageStock::where('from_id',$item_detail->id)->where('from','Opening Stock - Master')->first();
                        if(!$manage_stock){
                            $manage_stock = new ManageStock;
                            $manage_stock->from = 'Opening Stock - Master';
                            $manage_stock->from_id = $item_detail->id;
                            $manage_stock->save();
                        }
                        $manage_stock->date = now();
                        $manage_stock->item_detail_id = $item_detail->id;
                        $manage_stock->item_id = $item_detail->item_id;
                        $manage_stock->brand_id = $request->brand_id;
                        $manage_stock->category_id = $request->category_id;
                        $manage_stock->season_id = $request->season_id;

                        $manage_stock->quantity = $detail['opening_stock'];
                        $manage_stock->in_out = 'In';
                        $manage_stock->software_remarks = 'Master Stock In';
                        $manage_stock->save();

                        $stockIds[] = $manage_stock->id;
                    }
                }
                $detail_items = ItemDetail::whereNotIn('id',$itemDetail_ids)->where('item_id',$item->id)->delete();
                // $manage_stock = ManageStock::whereNotIn('id',$stockIds)->where('from','Opening Stock - Master')->whereIn('from_id',$itemDetail_ids)->delete();
            }
            $delete_article = Item::whereNotIn('id',$obsIds)->where('is_temp',1)->delete();
        }
        return redirect()->route('item.index')->with(['status' => 'Article Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $category = Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
        $season = Season::where('status',1)->get();
        return view('admin.item.add_edit',compact('category','brand','item','season'));
    }

    public function get_barcode(Request $request){
        $item_detail = ItemDetail::where('barcode_value',$request->barcode)->first();
        if($item_detail){
            if($item_detail->is_temp == 0 && $item_detail->status == 1){
                $data = [
                    'result' => 1,
                    'data' => $item_detail,
                ];
            }
            else{
                $data = [
                    'result' => -2,
                    'message' => 'This Barcode is Not usable due to inactive product',
                ];
            }
        }
        else{
            $data = [
                'result' => -1,
                'message' => 'Barcode Not Found',
            ];
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = Item::find($id);
        if($item){
            $item_detail = ItemDetail::where('item_id',$item->id)->delete();
            $manage_stock = ManageStock::where('item_id',$item->id)->delete();
            $item->delete();
            $data = [
                'result' => 1,
                'message' => 'Article Deleted Successfully',
            ];
        }
        else{
            $data = [
                'result' => -1,
                'message' => 'Something Error',
            ];
        }
       
        return $data;
    }
}

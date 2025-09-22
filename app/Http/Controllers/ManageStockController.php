<?php

namespace App\Http\Controllers;

use App\Models\ManageStock;
use App\Models\ItemDetail;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Season;
use Illuminate\Http\Request;
use PDF;

class ManageStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title ?? 'Stock In';
        $item_detail = ItemDetail::where('status',1)->where('is_temp',0)->get();
        return view('admin.manage_stock.index',compact('title','item_detail'));
    }
    public function edit_modal($id){
        $stock = ManageStock::find($id);
        return view('admin.manage_stock.modal',compact('stock'));
    }

    public function datatable(Request $request){
        $title = $request->title;
        if($title != 'View Statement'){
            $manage_stock = ManageStock::where('in_out',$title);
        }
        else{
            $manage_stock = ManageStock::where('item_detail_id',$request->article);
        }
        
        if($request->from_date){
            $manage_stock->where('date','>=',$request->from_date);
        }
        if($request->to_date){
            $manage_stock->where('date','<=',$request->to_date);
        }
        if($request->search){
            $manage_stock->where(function($q)use($request){
                $q->where('from','like','%'.$request->search.'%')
                ->orWhereHas('item_detail',function($q)use($request){
                    $q->where('article_name','like','%'.$request->search.'%')
                    ->orWhere('color','like','%'.$request->search.'%')
                    ->orWhere('size','like','%'.$request->search.'%');
                })
                ->orWhereHas('brand',function($q)use($request){
                    $q->where('name','like','%'.$request->search.'%');
                })
                ->orWhereHas('category',function($q)use($request){
                    $q->where('name','like','%'.$request->search.'%');
                });
            });
        }
       
        $manage_stock = $manage_stock->latest()->paginate($request->value ?? 50);
        return view('admin.manage_stock.datatable',compact('manage_stock'));
    }
    public function get_quantity(Request $request){
       
        $remainingStock = ManageStock::where('item_detail_id',$request->item_detail_id)
        ->select('id','item_detail_id', 'item_id', 'brand_id', 'category_id', 'from', 'from_id'
        ,\DB::raw('SUM(CASE WHEN in_out IN ("In", "GR") THEN quantity ELSE -quantity END) AS remaining'))
        ->groupBy(['item_detail_id','item_id', 'brand_id', 'category_id'])
        ->first();

        return response()->json(['result'=> $remainingStock]);
    }
    public function average(){
        $brand = Brand::where('status',1)->get();
        $category = Category::where('status',1)->get();
        $season = Season::where('status',1)->get();
        $grand_total_stock = ManageStock::sum(\DB::raw('CASE WHEN in_out IN ("In", "Gr") THEN quantity ELSE -quantity END'));
        $totals = \DB::table('manage_stocks as ms')
        ->leftJoin('item_details as id', 'ms.item_detail_id', '=', 'id.id')
        ->whereNull('ms.deleted_at')  // Exclude soft-deleted ManageStock
        ->whereNull('id.deleted_at')  // Exclude soft-deleted ItemDetail
        ->selectRaw('
            SUM(CASE WHEN ms.in_out IN ("In", "Gr") THEN ms.quantity * IFNULL(id.purchase_price, 0)
                    WHEN ms.in_out = "Out" THEN -ms.quantity * IFNULL(id.purchase_price, 0)
                    ELSE 0 END) as total_purchase_amount,
            SUM(CASE WHEN ms.in_out IN ("In", "Gr") THEN ms.quantity * IFNULL(id.selling_price, 0)
                    WHEN ms.in_out = "Out" THEN -ms.quantity * IFNULL(id.selling_price, 0)
                    ELSE 0 END) as total_sale_amount
        ')
        ->first();

        return view('admin.manage_stock.average_index',compact('totals','brand','category','season','grand_total_stock'));
    }
    public function average_datatable(Request $request){
        $querry =  ManageStock::select(
            'manage_stocks.id', 
            'manage_stocks.item_id', 
            'manage_stocks.item_detail_id', 
            'manage_stocks.brand_id', 
            'manage_stocks.category_id', 
            'manage_stocks.from', 
            'manage_stocks.from_id',
            \DB::raw('SUM(CASE WHEN in_out IN ("In", "Gr") THEN quantity ELSE -quantity END) AS remaining')
        )
        ->groupBy(['manage_stocks.item_id', 'manage_stocks.item_detail_id']);
        if ($request->search) {
            $querry->whereHas('item_detail', function ($query) use ($request) {
                $query->where('article_name', 'like','%'.$request->search.'%')
                ->orWhere('size', $request->search);
            })
            ->orWhereHas('brand', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }
        if($request->brand_id){
            $querry->where('manage_stocks.brand_id',$request->brand_id);
        }
        if($request->category_id){
            $querry->where('manage_stocks.category_id',$request->category_id);
        }
        if($request->season_id){
            $querry->where('manage_stocks.season_id',$request->season_id);
        }
        $remainingStock = $querry->paginate($request->value ?? 50);
        return view('admin.manage_stock.average_datatable', compact('remainingStock'));

    }
    public function view_statement(Request $request,$id){
        $title = 'View Statement';
        $article = ItemDetail::find($id);
        $item_detail = ItemDetail::where('status',1)->where('is_temp',0)->get();
        return view('admin.manage_stock.index',compact('title','article','item_detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item_detail = ItemDetail::find($request->item_detail_id);
        $stock = new ManageStock;
        $stock->from = 'Manual';
        $stock->from_id = 0;
        $stock->user_id = auth()->user()->id;
        $stock->date = $request->date;
        $stock->brand_id = $item_detail->brand_id;
        $stock->category_id = $item_detail->category_id;
        $stock->season_id = $item_detail->season_id;
        $stock->item_id = $item_detail->item_id;
        $stock->item_detail_id = $item_detail->id;
        $stock->quantity = $request->quantity;
        $stock->in_out = $request->in_out;
        $stock->software_remarks = 'Manually Stock In';
        $stock->save();
        $data = 
        [
            'result' => 1,
            'message' => 'Stock In Added Successful'
        ];
        return $data;
    }

    public function barcode_print(){
        $brand = Brand::where('status',1)->get();
        $category = Category::where('status',1)->get();
        $item_detail = ItemDetail::where('status',1)->where('is_temp',0)->get();
        return view('admin.barcode.index',compact('brand','category','item_detail'));
    }
    public function get_item_list(Request $request){
        $item_detail = ItemDetail::where('is_temp',0);
        if($request->brand_id){
            $item_detail->where('brand_id',$request->brand_id);
        }
        if($request->category_id){
            $item_detail->where('category_id',$request->category_id);
        }
        $item_detail = $item_detail->get();
        return view('admin.barcode.item_list',compact('item_detail'));
    }
    public function barcode_get_result(Request $request){
        $item_detail = ItemDetail::where('is_temp',0);
        if($request->brand_id){
            $item_detail->where('brand_id',$request->brand_id);
        }
        if($request->category_id){
            $item_detail->where('category_id',$request->category_id);
        }
        if($request->item_detail_id){
            $item_detail->whereIn('id',$request->item_detail_id);
        }
        $item_detail = $item_detail->get();
        return view('admin.barcode.result',compact('item_detail'));
    }
    public function get_barcode_print(Request $request)
    {
        $item_detail = ItemDetail::where('is_temp', 0);
    
        if ($request->brand_id)    $item_detail->where('brand_id', $request->brand_id);
        if ($request->category_id) $item_detail->where('category_id', $request->category_id);
        if ($request->item_detail_id) {
            $item_detail->whereIn('id', explode(',', $request->item_detail_id));
        }
        $item_detail = $item_detail->get();
    
        $html = view('admin.barcode.pdf', compact('item_detail'))->render();
        $html = preg_replace('/^\xEF\xBB\xBF|\x{FEFF}/u', '', $html); // strip BOM
        $html = ltrim($html); // remove leading whitespace/newlines

        if (ob_get_length()) ob_end_clean();
    
        // 100mm × 50mm in points (1 mm ≈ 2.83465 pt)
        $width  = 99.8 * 2.83465;   // 283.465
        $height = 38.8  * 2.83465;   // 141.732
    
        $pdf = PDF::loadHTML($html)
            ->setPaper([0, 0, $width, $height], 'portrait'); // one label per page, portrait
            // ->setOption('dpi', 300); // (optional) sharper barcodes
    
        return $pdf->stream('barcode_result.pdf');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function show(ManageStock $manageStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageStock $manageStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageStock $manageStock)
    {
        $manageStock->quantity = $request->quantity;
        $manageStock->software_remarks = 'Quantity Updated';
        $manageStock->update();
        $data = 
        [
            'result' => 1,
            'message' => 'Stock Updated',
        ];
        return  $data;
    }
    public function report(Request $request){
        return view('admin.report.stock.index');
    }
    public function report_datatable(Request $request)
    {
        $title = $request->filter; // "All", "Zero Stock", "Alert Stock", "Over Stock"

        $query = ManageStock::select(
                'manage_stocks.item_id',
                'manage_stocks.item_detail_id',
                \DB::raw('SUM(CASE WHEN manage_stocks.in_out IN ("In","Gr") 
                                THEN manage_stocks.quantity 
                                ELSE -manage_stocks.quantity END) AS remaining'),
                \DB::raw('COALESCE(item_details.min_alert, 5) AS min_alert'),
                \DB::raw('COALESCE(item_details.max_alert, 100) AS max_alert'),
                // ✅ Build classification directly in SQL
                \DB::raw("CASE 
                            WHEN SUM(CASE WHEN manage_stocks.in_out IN ('In','Gr') 
                                        THEN manage_stocks.quantity 
                                        ELSE -manage_stocks.quantity END) <= 0 
                                THEN 'Zero Stock'
                            WHEN SUM(CASE WHEN manage_stocks.in_out IN ('In','Gr') 
                                        THEN manage_stocks.quantity 
                                        ELSE -manage_stocks.quantity END) > 0
                                AND SUM(CASE WHEN manage_stocks.in_out IN ('In','Gr') 
                                            THEN manage_stocks.quantity 
                                            ELSE -manage_stocks.quantity END) 
                                    <= COALESCE(item_details.min_alert, 5) 
                                THEN 'Alert Stock'
                            WHEN SUM(CASE WHEN manage_stocks.in_out IN ('In','Gr') 
                                        THEN manage_stocks.quantity 
                                        ELSE -manage_stocks.quantity END) > COALESCE(item_details.max_alert, 100) 
                                THEN 'Over Stock'
                            ELSE 'Normal'
                        END AS classification")
            )
            ->join('item_details', 'item_details.id', '=', 'manage_stocks.item_detail_id')
            ->groupBy(
                'manage_stocks.item_id',
                'manage_stocks.item_detail_id',
                'item_details.min_alert',
                'item_details.max_alert'
            )
            ->orderBy('manage_stocks.item_id', 'asc');

        // ✅ Apply search filter
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('item', function ($q) use ($search) {
                    $q->where('article_name', 'like', "%$search%");
                })
                ->orWhereHas('item_detail', function ($q) use ($search) {
                    $q->where('size', 'like', "%$search%")
                    ->orWhere('color', 'like', "%$search%");
                });
            });
        }

        // ✅ Apply classification filter
        // ✅ Apply classification filter
        if ($title !== 'All') {
            $query->having('classification', '=', $title);
        } else {
            $query->havingRaw("classification IN ('Zero Stock', 'Alert Stock', 'Over Stock')");
        }

        $results = $query->get();

        return view('admin.report.stock.datatable', compact('results', 'title'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $manage_stock = ManageStock::find($id);
        $manage_stock->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Deleted Successfully',
        ];
        return $data;
    }
}

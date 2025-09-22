<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\AccountMaster;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Season;
use App\Models\PaymentMethod;
use App\Models\ManageStock;
use App\Models\Ledger;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.purchase.index');
    }

    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = PurchaseOrder::query();
        if($request->search){
            $querry->where('purchase_no','like','%'.$request->search.'%')
            ->orWhereHas('vendor',function($query) use ($request){
                $query->where('name','like','%'.$request->search.'%');
            });
        }
        if($request->from_date){
            $querry->where('purchase_date','>=',$request->from_date);
        }
        if($request->to_date){
            $querry->where('purchase_date','<=',$request->to_date);
        }
        if($request->vendor_id){
            $querry->where('vendor_id',$request->vendor_id);
        }
        $purchase = $querry->latest()->paginate($number);
        return view('admin.purchase.datatable',compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_method = PaymentMethod::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $category = Category::where('status',1)->get();
        $seasons = Season::where('status',1)->get();
        $vendors = AccountMaster::where('status',1)->where('from','Vendor')->get();
        return view('admin.purchase.add_edit',compact('vendors','brands','category','seasons','payment_method'));
    }

    public function add_article_list(Request $request){
        $item = Item::where('article_name',$request->article_no)->first();
        if($item){
            $check_detail = ItemDetail::where('article_name',$request->article_no)->where('size',$request->size)->first();
            if($check_detail){
                $data = 
                [
                   'view' => '',
                    'item_detail' => 0,
                    'result' => -1,
                    'message' => 'Article Name Already Used',
                ];
            }
            else{
                $item_detail = new ItemDetail();
                $item_detail->item_id = $item->id;
                $item_detail->brand_id = $request->brand_id;
                $item_detail->category_id = $request->category_id;
                $item_detail->season_id = $request->season_id;
                $item_detail->article_name = $request->article_no;
                $item_detail->size = $request->size;
                // $item_detail->color = $request->color;
                $item_detail->quantity = $request->quantity;
                $item_detail->purchase_price = $request->purchase_price;
                $item_detail->selling_price = $request->selling_price;
                $item_detail->save();

                $data = 
                [
                    'view' => view('admin.purchase.item_list',compact('item_detail','item'))->render(),
                    'result' => 1,
                    'item_detail' => $item_detail,
                    'message' => 'Article Added Successfully',
                ];

            }
        }
        else{
            $item = new Item();
            $item->article_name = $request->article_no;
            $item->brand_id = $request->brand_id;
            $item->category_id = $request->category_id;
            $item->season_id = $request->season_id;
            $item->save();
            if($item){
                $check_detail = ItemDetail::where('article_name',$request->article_no)->where('size',$request->size)->first();
                if($check_detail){
                    $data = 
                    [
                        'view' => '',
                        'item_detail' => 0,
                        'result' => -1,
                        'message' => 'Article Name Already Used',
                    ];
                }
                else{
                    $item_detail = new ItemDetail();
                    $item_detail->item_id = $item->id;
                    $item_detail->brand_id = $request->brand_id;
                    $item_detail->category_id = $request->category_id;
                    $item_detail->season_id = $request->season_id;
                    $item_detail->article_name = $request->article_no;
                    $item_detail->size = $request->size;
                    // $item_detail->color = $request->color;
                    $item_detail->quantity = $request->quantity;
                    $item_detail->purchase_price = $request->purchase_price;
                    $item_detail->selling_price = $request->selling_price;
                    $item_detail->save();

                    $data = 
                    [
                        'view' => view('admin.purchase.item_list',compact('item_detail','item'))->render(),
                        'result' => 1,
                        'item_detail' => $item_detail,
                        'message' => 'Article Added Successfully',
                    ];
                }
            }
        }
        return $data;
    }
    public function remove_article(Request $request){
        $item_detail_id = ItemDetail::where('id',$request->item_detail_id)->delete();
        $check = ItemDetail::where('item_id',$request->item_id)->get();
        if($check->count() <= 0){
            $item = Item::where('id',$request->item_id)->delete();
        }
        $manage_stock = ManageStock::where('item_detail_id',$request->item_detail_id)->delete();
        $data = [
            'result' => 1,
            'message' => 'Article Removed Successfully',
        ];
        
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $input['payment_method'] = json_encode($request->payment_method);
        $input['status'] = 1;
        $purchase = PurchaseOrder::updateOrCreate(['id' => $input['id']],$input);
        if($input['id'] == 0){
            $purchase->purchase_no = 'PO-0'.$purchase->id;
            $purchase->save();
        }
        if($request->has('add')){
            $obsIds = [];
            $item_ids = [];
            $stockIds = [];
            foreach($request->get('add',[]) as $o => $obs){
                $obs['max_alert'] = 100;
                $obs['min_alert'] = 5;
                $obs['is_temp'] = 0;
                $obs['from'] = 'Purchase';
                $obs['from_id'] = $purchase->id;
                $item_detail = ItemDetail::updateOrCreate(['id' => $obs['item_detail_id']],$obs);
                $item_detail->barcode_value = $obs['article_name'].'-'.$item_detail->size;
                $item_detail->save();

                $check = ItemDetail::where('item_id',$obs['item_id'])->where('is_temp',1)->get()->count();
                if($check <= 0){
                    $item = Item::find($obs['item_id']);
                    $item->from = 'Purchase';
                    $item->from_id = $purchase->id;
                    $item->is_temp = 0;
                    $item->save();
                }
                else{
                    $item = Item::find($obs['item_id']);
                    $item->from = 'Purchase';
                    $item->from_id = $purchase->id;
                    $item->is_temp = 1;
                    $item->save();
                }
                $obsIds[] = $item_detail->id;
                $item_ids[] = $item->id;
                if($obs['opening_stock'] > 0 &&  $item_detail->is_temp == 0){
                    $manage_stock = ManageStock::where('from_id',$item_detail->id)->where('from','Purchase Stock - ' . $purchase->id)->first();
                    if(!$manage_stock){
                        $manage_stock = new ManageStock;
                        $manage_stock->from = 'Purchase Stock - ' . $purchase->id;
                        $manage_stock->from_id = $item_detail->id;
                        $manage_stock->save();
                    }
                    $manage_stock->date = now();
                    $manage_stock->item_detail_id = $item_detail->id;
                    $manage_stock->item_id = $item_detail->item_id;
                    $manage_stock->brand_id = $item_detail->brand_id;
                    $manage_stock->category_id = $item_detail->category_id;
                    $manage_stock->season_id = $item_detail->season_id;
                    $manage_stock->quantity = $obs['opening_stock'];
                    $manage_stock->in_out = 'In';
                    $manage_stock->software_remarks = 'Purchase Stock In - '.$purchase->id;

                    $manage_stock->save();

                    $stockIds[] = $manage_stock->id;
                }
                else{
                    $manage_stock = ManageStock::where('from_id',$item_detail->id)->where('from','Purchase Stock - ' . $purchase->id)->first();
                    if($manage_stock){
                        $manage_stock->delete();
                    }
                }
               
            }
            $detail_items = ItemDetail::whereNotIn('id',$obsIds)->whereIn('item_id',$item_ids)->delete();
        }
        //Ledger 
        $ledger = Ledger::where('from','Purchase Vendor')->where('from_id',$purchase->id)->first();
        if(!$ledger){
            $ledger = new Ledger;
            $ledger->from = 'Purchase Vendor';
            $ledger->from_id = $purchase->id;
        }
        $ledger->user_id = auth()->user()->id;
        $ledger->account_id = $purchase->vendor_id;
        $ledger->date = $purchase->purchase_date;
        $ledger->amount = $purchase->total_purchase_amount;
        $ledger->dr_cr = 'Cr';
        $ledger->status = 1;
        $ledger->save();

        if ($request->has('payment_details')) {

            $fromField = 'Payment To Vendor - ' . $purchase->id;
        
            // Fetch existing payment ledger entries for this purchase
            $existingLedgers = Ledger::where('from', $fromField)
                ->where('from_id', $purchase->id)
                ->where('dr_cr', 'Dr')
                ->get()
                ->keyBy(function($item) {
                    // Use payment method name as key
                    return PaymentMethod::find($item->payment_master_id)->name ?? 'CASH';
                });
        
            // Step 1: Delete removed payment methods
            foreach ($existingLedgers as $methodName => $ledger) {
                if (!isset($request->payment_details[$methodName])) {
                    $ledger->delete();
                }
            }
        
            // Step 2: Update existing or create new ledger entries
            foreach ($request->payment_details as $key => $amount) {
                $payment_method_id = PaymentMethod::where('name', $key)->first()->id ?? 'CASH';
        
                if (isset($existingLedgers[$key])) {
                    // Update existing entry
                    $ledger = $existingLedgers[$key];
                    $ledger->amount = $amount;
                    $ledger->save();
                } else {
                    // Create new entry
                    $ledger = new Ledger;
                    $ledger->from = $fromField;
                    $ledger->from_id = $purchase->id;
                    $ledger->payment_method_id = $payment_method_id;
                    $ledger->account_id = $purchase->vendor_id;
                    $ledger->user_id = auth()->user()->id;
                    $ledger->date = $purchase->purchase_date;
                    $ledger->amount = $amount;
                    $ledger->dr_cr = 'Dr';
                    $ledger->status = 1;
                    $ledger->save();
                }
            }
        }
        
        return redirect()->route('purchase.index')->with(['status' => 'Purchase Added Successfully']);
    }
    public function report_index(Request $request){
        $vendors = AccountMaster::where('from','Vendor')->orderBy('name')->get();
        return view('admin.purchase.report_index',compact('vendors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseOrder::find($id);
        $payment_method = PaymentMethod::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $category = Category::where('status',1)->get();
        $seasons = Season::where('status',1)->get();
        $vendors = AccountMaster::where('status',1)->where('from','Vendor')->get();
        return view('admin.purchase.add_edit',compact('vendors','brands','category','seasons','payment_method','purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $purchase = PurchaseOrder::find($id);
        if($purchase){
            $item_detail = ItemDetail::where('from','Purchase')->where('from_id',$purchase->id)->get();
            foreach($item_detail as $detail){
               
                $detail->delete();
                $check_first = ItemDetail::where('item_id',$detail->item_id)->get()->count();
                if($check_first <= 0){
                    $item = Item::find($detail->item_id);
                    $item->delete();
                }
            }
           
        }
        $manage_stock = ManageStock::where('from','Purchase Stock - '.$purchase->id)->delete();
        $ledger_vendor = Ledger::where('from','Purchase Vendor')->where('from_id',$purchase->id)->delete();
        $ledger_payment = Ledger::where('from','Payment To Vendor - '.$purchase->id)->where('account_id',$purchase->vendor_id)->delete();
        $purchase->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Deleted Successfully',
        ];
        return $data;
    }
}

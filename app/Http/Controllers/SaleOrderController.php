<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use App\Models\PaymentMethod;
use App\Models\ManageStock;
use App\Models\Ledger;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\AccountMaster;
use Illuminate\Http\Request;
use PDF;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sale.index');
    }

    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = SaleOrder::query();
        if($request->search){
            $querry->where('sale_no','like','%'.$request->search.'%')
            ->orWhereHas('account',function($query) use ($request){
                $query->where('name','like','%'.$request->search.'%');
            });
        }
        if($request->from_date){
            $querry->where('sale_date','>=',$request->from_date);
        }
        if($request->to_date){
            $querry->where('sale_date','<=',$request->to_date);
        }
        if($request->customer_id){
            $querry->where('account_id',$request->customer_id);
        }

        $sale = $querry->latest()->paginate($number);
        return view('admin.sale.datatable',compact('sale'));
    }

    public function add_item(Request $request){
        $item = ItemDetail::where('barcode_value',$request->barcode_value)->where('status',1)->first();
        if($item){
            $item_detail = ItemDetail::where('id',$item->id)->first();
            $remainingStock = ManageStock::where('item_detail_id',$item->id)
            ->select('id','item_detail_id', 'item_id', 'brand_id', 'category_id', 'from', 'from_id'
            ,\DB::raw('SUM(CASE WHEN in_out IN ("In", "GR") THEN quantity ELSE -quantity END) AS remaining'))
            ->groupBy(['item_detail_id','item_id', 'brand_id', 'category_id'])
            ->first();
            $data = 
            [
                'result' => 1,
                'message' => 'Article Found',
                'view' => view('admin.sale.item',compact('item_detail','remainingStock'))->render(),
                'item_detail' => $item_detail,
                'stock' => $remainingStock
            ];
    
            return response()->json($data);
        }else{
            $data = 
            [
                'result' => -1,
                'message' => 'Article Not Found'
            ];
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_method = PaymentMethod::where('status',1)->get();
        $account_master = AccountMaster::where('status',1)->where('from','Customer')->get();
        return view('admin.sale.add_edit',compact('account_master','payment_method'));
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
        $sale = SaleOrder::updateOrCreate(['id' => $input['id']],$input);
        if($input['id'] == 0){
            $sale->sale_no = 'AF-0'.$sale->id;
            $sale->save();
        }
        if($request->has('add')){
            $obsIds = [];
            $stockIds = [];
            foreach($request->get('add',[]) as $o => $obs){
                $obs['user_id'] = auth()->user()->id;
                $obs['from'] = 'Sale';
                $obs['from_id'] = $sale->id;
                $obs['date'] = $sale->sale_date;
                $item_detail = ItemDetail::find($obs['item_detail_id']);
                $obs['item_id'] = $item_detail->item_id;
                $obs['brand_id'] = $item_detail->brand_id;
                $obs['category_id'] = $item_detail->category_id;
                $obs['season_id'] = $item_detail->season_id;
                $obs['in_out'] = 'Out';
                $obs['purchase_price'] = $item_detail->purchase_price;
                $obs['software_remarks'] = 'Sale Stock Out - '.$sale->id;
                $manage_stock = ManageStock::updateOrCreate(['id' => $obs['id']],$obs);
                $obsIds[] = $manage_stock->id;
            }
            ManageStock::where('from','Sale')->where('from_id',$sale->id)->whereNotIn('id',$obsIds)->delete();
        }
        $ledger = Ledger::where('from','Sale Customer')->where('from_id',$sale->id)->first();
        if(!$ledger){
            $ledger = new Ledger;
            $ledger->from = 'Sale Customer';
            $ledger->from_id = $sale->id;
        }
        $ledger->user_id = auth()->user()->id;
        $ledger->payment_method_id = 0;
        $ledger->account_id = $request->account_id;
        $ledger->date = $sale->sale_date;
        $ledger->amount = $sale->total_sale_amount;
        $ledger->dr_cr = 'Dr';
        $ledger->status = 1;
        $ledger->save();

        if ($request->has('payment_details')) {
            $fromField = 'Payment Recd From Customer - ' . $sale->id;
            $existingLedgers = Ledger::where('from', $fromField)
            ->where('from_id', $sale->id)
            ->where('dr_cr', 'Cr')
            ->get()
            ->keyBy(function($item) {
                // Use payment method name as key
                return PaymentMethod::find($item->payment_method_id)->name ?? 'CASH';
            });
            foreach ($existingLedgers as $methodName => $ledger) {
                if (!isset($request->payment_details[$methodName])) {
                    $ledger->delete();
                }
            }
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
                    $ledger->from_id = $sale->id;
                    $ledger->payment_method_id = $payment_method_id;
                    $ledger->account_id = $sale->account_id;
                    $ledger->user_id = auth()->user()->id;
                    $ledger->date = $sale->sale_date;
                    $ledger->amount = $amount;
                    $ledger->dr_cr = 'Cr';
                    $ledger->status = 1;
                    $ledger->save();
                }
            }
        }
        $pdfPreviewUrl = route('sale.pos', $sale);
        return redirect()->route('sale.index')->with(['status' => 'Sale Order Added Successfully','pdf_url'=>$pdfPreviewUrl]);
    }
    public function pos($id){
        $sale = SaleOrder::find($id);
        $view = view('admin.sale.pos', compact('sale'));
        $html = $view->render();
        $pdf = PDF::loadHTML($html);
        $pdf->getDomPDF()->set_option('defaultFont', 'Arial Unicode MS');
        $pdf->getDomPDF()->set_option('fontCache', public_path('font_cache'));
        
        $pdf->getDomPDF()->setPaper([0, 0, 204, 500], 'portrait', 'mm');
        return $pdf->stream($sale->sale_no.'.pdf');
    }

    public function report_index(Request $request){
        $customers = AccountMaster::where('from','Customer')->orderBy('name')->get();
        return view('admin.sale.report_index',compact('customers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = SaleOrder::find($id);
        $payment_method = PaymentMethod::where('status',1)->get();
        $account_master = AccountMaster::where('status',1)->where('from','Customer')->get();
        return view('admin.sale.add_edit',compact('account_master','payment_method','sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $sale = SaleOrder::find($id);
        $manage_stock = ManageStock::where('from','Sale')->where('from_id',$sale->id)->delete();
        $ledger = Ledger::where('from','Sale Customer')->where('from_id',$sale->id)->delete();
        $ledger = Ledger::where('from','Payment Recd From Customer - '.$sale->id)->where('from_id',$sale->id)->delete();
        $sale->delete();
        $data = [
            'result' => 1,
            'message' => 'Sale Order Deleted Successfully',
        ];
        return $data;
    }
}

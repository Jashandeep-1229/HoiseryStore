<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Ledger;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payment_master.index');
    }
    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = PaymentMethod::query();
        if($request->search){
            $querry->where('name','like','%'.$request->search.'%');
        }
        $payment_master = $querry->latest()->paginate($number);
        return view('admin.payment_master.datatable',compact('payment_master'));
    }
    public function edit_modal(Request $request){
        $payment_master = PaymentMethod::find($request->id);
        return view('admin.payment_master.modal',compact('payment_master'));
    }

    public function payment_report_index(Request $request){
        return view('admin.report.payment.index');
    }

    public function payment_report_widget(Request $request)
    {
        $payment = PaymentMethod::where('status', 1)->get();
        $startDate = '2025-11-12';
        // ✅ Get Opening Balances (before from_date)
        $opening = Ledger::select(
                'payment_method_id',
                \DB::raw("
                    SUM(CASE 
                        WHEN dr_cr = 'Cr' THEN amount
                        WHEN dr_cr = 'Dr' THEN -amount
                        ELSE 0 
                    END) as opening_balance
                ")
            )
            ->whereNotNull('payment_method_id')
            ->where('payment_method_id', '!=', 0)
            ->whereDate('date', '>=', $startDate)
            ->when($request->from_date, function ($q) use ($request) {
                $q->where('date', '<', $request->from_date);
            })
            ->groupBy('payment_method_id')
            ->get()
            ->keyBy('payment_method_id');
    
        // ✅ Get Transactions Within Date Range
        $current = Ledger::select(
                'payment_method_id',
                \DB::raw("
                    SUM(CASE 
                        WHEN dr_cr = 'Cr' THEN amount
                        WHEN dr_cr = 'Dr' THEN -amount
                        ELSE 0 
                    END) as net_balance
                ")
            )
            ->whereNotNull('payment_method_id')
            ->where('payment_method_id', '!=', 0)
            ->whereDate('date', '>=', $startDate)
            ->when($request->from_date, function ($q) use ($request) {
                $q->where('date', '>=', $request->from_date);
            })
            ->when($request->to_date, function ($q) use ($request) {
                $q->where('date', '<=', $request->to_date);
            })
            
            ->groupBy('payment_method_id')
            ->get()
            ->keyBy('payment_method_id');
    
        // ✅ Combine both into one final closing balance
        $result = $payment->map(function ($pay) use ($opening, $current) {
            $opening_balance = $opening[$pay->id]->opening_balance ?? 0;
            $net_balance = $current[$pay->id]->net_balance ?? 0;
    
            return [
                'payment_method_id' => $pay->id,
                'payment_method_name' => $pay->name ?? 'N/A',
                // 🔹 Closing = Opening + Current
                'closing_balance' => $opening_balance + $net_balance,
            ];
        });
    
        return view('admin.report.payment.widget', compact('result'));
    }
    
    public function payment_report_datatable(Request $request){
        $ledger = Ledger::where('payment_method_id',($request->payment_method_id ?? 1))
        ->when($request->from_date, function ($q) use ($request) {
            $q->where('date', '>=', $request->from_date);
        })
        ->when($request->to_date, function ($q) use ($request) {
            $q->where('date', '<=', $request->to_date);
        });
        $startDate = '2025-11-12';
       
        $value = $request->value ?? 250;
       
        $ledger = $ledger->whereDate('date', '>=', $startDate)->orderBy('date','desc')->paginate($value);
        return view('admin.report.payment.datatable',compact('ledger'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment_master = PaymentMethod::find($request->payment_master_id);
        if($payment_master){
            $check = PaymentMethod::where('name',$request->name)->where('id','!=',$payment_master->id)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Payment Master Name Already Used'
                ];
            }else{
                $payment_master->name = $request->name;
                $payment_master->save();
                $data = [
                    'result' => 1,
                    'message' => 'Payment Master Updated Successfully'
                ];
            }
        }else{
            $check = PaymentMethod::where('name',$request->name)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Payment Master Name Already Used'
                ];
            }else{
                $payment_master = new PaymentMethod();
                $payment_master->name = $request->name;
                $payment_master->status = 1;
                $payment_master->save();
                $data = [
                    'result' => 1,
                    'message' => 'Payment Master Added Successfully'
                ];
            }
        }
        return $data;
    }

    public function change_status($id){
        $payment_master = PaymentMethod::find($id);
        if($payment_master){
            $payment_master->status = $payment_master->status == 1 ? 0 : 1;
            $payment_master->save();
            $data = [
                'result' => 1,
                'message' => 'Status Changed Successfully'
            ];
        }
        
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $payment_master = PaymentMethod::find($id);
        $payment_master->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Deleted Successfully',
        ];
        return $data;
    }

    public function payment_list(){
        $payments = PaymentMethod::where('status',1)->get();
        return view('admin.payment_master.payment_list',compact('payments'));
    }
}

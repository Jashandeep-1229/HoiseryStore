<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
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
}

<?php

namespace App\Http\Controllers;

use App\Models\AccountMaster;
use Illuminate\Http\Request;

class AccountMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.account_master.index');
    }
    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = AccountMaster::query();
        if($request->search){
            $querry->where('name','like','%'.$request->search.'%');
        }
        $account_master = $querry->latest()->paginate($number);
        return view('admin.account_master.datatable',compact('account_master'));
    }
    public function edit_modal(Request $request){
        $account_master = AccountMaster::find($request->id);
        return view('admin.account_master.modal',compact('account_master'));
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
        $account_master = AccountMaster::find($request->account_master_id);
        if($account_master){
            $checkName = AccountMaster::where('name',$request->name)->where('id','!=',$account_master->id)->first();
            $checkPhone = AccountMaster::where('phone_no',$request->phone_no)->where('id','!=',$account_master->id)->first();
            if($checkName){
                $data = [
                    'result' => -1,
                    'message' => 'Account Master Name Already Used'
                ];
            }elseif($checkPhone && $request->phone_no){
                $data = [
                    'result' => -1,
                    'message' => 'Phone Number Already Used'
                ];
            }else{
                $account_master->name = $request->name;
                $account_master->phone_no = $request->phone_no;
                $account_master->business_name = $request->business_name;
                $account_master->city = $request->city;
                $account_master->from = $request->from;
                $account_master->save();
                $data = [
                    'result' => 1,
                    'id' => $account_master->id,
                    'name' => $account_master->name,
                    'message' => 'Account Master Updated Successfully'
                ];
            }
        }else{
            $checkName = AccountMaster::where('name',$request->name)->first();
            $checkPhone = AccountMaster::where('phone_no',$request->phone_no)->first();
            if($checkName){
                $data = [
                    'result' => -1,
                    'message' => 'Account Master Name Already Used'
                ];
            }elseif($checkPhone && $request->phone_no){
                $data = [
                    'result' => -1,
                    'message' => 'Phone Number Already Used'
                ];
            }else{
                $account_master = new AccountMaster();
                $account_master->name = $request->name;
                $account_master->phone_no = $request->phone_no;
                $account_master->business_name = $request->business_name;
                $account_master->city = $request->city;
                $account_master->from = $request->from ?? 'Vendor';
                $account_master->status = 1;
                $account_master->save();
                $data = [
                    'result' => 1,
                    'id' => $account_master->id,
                    'name' => $account_master->name,
                    'message' => 'Account Master Added Successfully'
                ];
            }
        }
        return $data;
    }

    public function change_status($id){
        $account_master = AccountMaster::find($id);
        if($account_master){
            $account_master->status = $account_master->status == 1 ? 0 : 1;
            $account_master->save();
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
     * @param  \App\Models\AccountMaster  $accountMaster
     * @return \Illuminate\Http\Response
     */
    public function show(AccountMaster $accountMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountMaster  $accountMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountMaster $accountMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountMaster  $accountMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountMaster $accountMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountMaster  $accountMaster
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $account_master = AccountMaster::find($id);
        $account_master->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Deleted Successfully',
        ];
        return $data;
    }
    public function vendor_list(){
        $vendor = AccountMaster::where('status',1)->where('from','Vendor')->get();
        return view('admin.account_master.vendor_list',compact('vendor'));
    }
    public function customer_list(){
        $customer = AccountMaster::where('status',1)->where('from','Customer')->get();
        return view('admin.account_master.customer_list',compact('customer'));
    }

    public function expense_list(){
        $expense = AccountMaster::where('status',1)->where('from','Expense')->get();
        return view('admin.account_master.expense_list',compact('expense'));
    }
    
    public function income_list(){
        $income = AccountMaster::where('status',1)->where('from','Income')->get();
        return view('admin.account_master.income_list',compact('income'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\AccountMaster;
use App\Models\PaymentMethod;
use App\Models\ManageStock;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function expense_index()
    {
        $account_expense = AccountMaster::where('from','Expense')->get();
        $payment_master = PaymentMethod::where('status',1)->get();
        return view('admin.expense.index',compact('account_expense','payment_master'));
    }
    public function expense_datatable(Request $request){
        $query = Ledger::where('from','Expense - Manually');
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('remarks','like','%'.$request->search.'%')
                ->orWhereHas('account',function($abc) use ($request){
                    $abc->where('name','like','%'.$request->search.'%');
                })
                ->orWhereHas('payment_method',function($abc) use ($request){
                    $abc->where('name','like','%'.$request->search.'%');
                });
            });
        }
        if($request->from_date){
            $query->where('date','>=',$request->from_date);
        }
        if($request->to_date){
            $query->where('date','<=',$request->to_date);
        }
        $expense = $query->orderBy('date','desc')->paginate($request->value ?? 50);
        return view('admin.expense.datatable',compact('expense'));
    }
    public function  expense_edit_modal(Request $request,$id){
        $expense = Ledger::find($id);
        $account_expense = AccountMaster::where('from','Expense')->get();
        $payment_master = PaymentMethod::where('status',1)->get();
        return view('admin.expense.modal',compact('expense','account_expense','payment_master'));
    }

    public function expense_store(Request $request){
        if(($request->id ?? 0) != 0){
            $expense = Ledger::find($request->id);
        }
        else{
            $expense = new Ledger();
            $expense->user_id = auth()->user()->id;
            $expense->from = 'Expense - Manually';
            $expense->from_id = 0;
        }
    
        $expense->date = $request->date;
        $expense->account_id = $request->expense_id;
        $expense->payment_method_id = $request->payment_method_id;
        $expense->amount = $request->amount;
        $expense->dr_cr = 'Dr';
        $expense->status = 1;
        $expense->remarks = $request->remarks;
        $expense->save();
        $data = [
            'result' => 1,
            'message' => 'Expneses Added Successfully'
        ];
        return $data;

    }
    public function expense_delete($id){
        $ledger = Ledger::find($id);
        $ledger->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Expense Deleted Successfully',
        ];
        return $data;
    }
    public function income_index()
    {
        $account_income = AccountMaster::where('from','Income')->get();
        $payment_master = PaymentMethod::where('status',1)->get();
        return view('admin.income.index',compact('account_income','payment_master'));
    }
    public function income_datatable(Request $request){
        $query = Ledger::where('from','Income - Manually');
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('remarks','like','%'.$request->search.'%')
                ->orWhereHas('account',function($abc) use ($request){
                    $abc->where('name','like','%'.$request->search.'%');
                })
                ->orWhereHas('payment_method',function($abc) use ($request){
                    $abc->where('name','like','%'.$request->search.'%');
                });
            });
        }
        if($request->from_date){
            $query->where('date','>=',$request->from_date);
        }
        if($request->to_date){
            $query->where('date','<=',$request->to_date);
        }
        $income = $query->orderBy('date','desc')->paginate($request->value ?? 50);
        return view('admin.income.datatable',compact('income'));
    }
    public function  income_edit_modal(Request $request,$id){
        $income = Ledger::find($id);
        $account_income = AccountMaster::where('from','Income')->get();
        $payment_master = PaymentMethod::where('status',1)->get();
        return view('admin.income.modal',compact('income','account_income','payment_master'));
    }

    public function income_store(Request $request){
        if(($request->id ?? 0) != 0){
          
            $income = Ledger::find($request->id);
        }
        else{
            $income = new Ledger();
            $income->user_id = auth()->user()->id;
            $income->from = 'Income - Manually';
            $income->from_id = 0;
        }
    
        $income->date = $request->date;
        $income->account_id = $request->income_id;
        $income->payment_method_id = $request->payment_method_id;
        $income->amount = $request->amount;
        $income->dr_cr = 'Cr';
        $income->status = 1;
        $income->remarks = $request->remarks;
        $income->save();
        $data = [
            'result' => 1,
            'message' => 'Income Added Successfully'
        ];
        return $data;

    }
    public function income_delete($id){
        $ledger = Ledger::find($id);
        $ledger->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Income Deleted Successfully',
        ];
        return $data;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->from;
        return view('admin.ledger.index',compact('title'));
    }

    public function edit_modal($id){
        $ledger = Ledger::find($id);
        $payment_master = PaymentMethod::where('status',1)->get();
        return view('admin.ledger.modal',compact('ledger','payment_master'));
    }

    public function transaction_index(){
        return view('admin.report.transaction.index');
    }

    public function transaction_datatable(Request $request){
        $querry = Ledger::query();
        if($request->from_date){
            $querry->where('date','>=',$request->from_date);
        }
        if($request->to_date){
            $querry->where('date','<=',$request->to_date);
        }
        if($request->search){
            $querry->where(function($q) use ($request){
                $q->where('remarks','like','%'.$request->search.'%')
                ->orWhereHas('account',function($abc) use ($request){
                    $abc->where('name','like','%'.$request->search.'%');
                })
                ->orWhereHas('payment_method',function($abc) use ($request){
                    $abc->where('name','like','%'.$request->search.'%');
                });
            });
        }
        
        $totals = [
            'expense' => (clone $querry)->where('from', 'Expense - Manually')->sum('amount'),
            'income' => (clone $querry)->where('from', 'Income - Manually')->sum('amount'),
            'purchase' => (clone $querry)->where('from', 'Purchase Vendor')->sum('amount'),
            'sale' => (clone $querry)->where('from', 'Sale Customer')->sum('amount'),
            'payment' => (clone $querry)->where('from', 'like', 'Payment To Vendor%')->sum('amount'),
            'received' => (clone $querry)->where('from', 'like', 'Payment Recd From Customer%')->sum('amount'),
        ];
        $ledger = $querry->orderBy('date','desc')->where('payment_method_id','!=',0)->paginate($request->value ?? 50);
        return view('admin.report.transaction.datatable',compact('ledger','totals'));
    }

    public function stock_index(){
        return view('admin.report.top_selling.index');
    }

    public function stock_datatable(Request $request){
        $querry = ManageStock::select(
            'item_details.article_name',
            'brands.name as brand_name',
            'categories.name as category_name',
            \DB::raw('SUM(manage_stocks.quantity) as total_out')
        )
        ->join('item_details', 'manage_stocks.item_detail_id', '=', 'item_details.id')
        ->join('brands', 'item_details.brand_id', '=', 'brands.id')
        ->join('categories', 'item_details.category_id', '=', 'categories.id')
        ->where('manage_stocks.in_out', 'Out') // only sales
        ->when($request->from_date, function ($query) use ($request) {
            $query->whereDate('manage_stocks.date', '>=', $request->from_date);
        })
        ->when($request->to_date, function ($query) use ($request) {
            $query->whereDate('manage_stocks.date', '<=', $request->to_date);
        })
        ->when($request->search, function ($query) use ($request) {
            $query->whereHas('item_detail', function ($q) use ($request) {
                $q->where('article_name', 'like', '%' . $request->search . '%');
            });
        })
        ->groupBy('item_details.article_name', 'brands.name', 'categories.name')
        ->orderByDesc('total_out')
        ->paginate($request->value ?? 50);
        return view('admin.report.top_selling.datatable',compact('querry'));
    }

    public function profit_index(){
        return view('admin.report.profit.index');
    }

    public function profit_datatable(Request $request){
        $querry = Ledger::query();
        if($request->from_date){
            $querry->where('date','>=',$request->from_date);
        }
        if($request->to_date){
            $querry->where('date','<=',$request->to_date);
        }
       // --- Vendor Payments (per account) ---
        $vendorPayments = Ledger::select(
            'account_id',
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Purchase Vendor%' THEN amount ELSE 0 END) as total_cr"),
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Payment To Vendor%' THEN amount ELSE 0 END) as total_dr"),
            \DB::raw("(SUM(CASE WHEN `from` LIKE 'Purchase Vendor%' THEN amount ELSE 0 END) -
                    SUM(CASE WHEN `from` LIKE 'Payment To Vendor%' THEN amount ELSE 0 END)) as due")
        )
        ->groupBy('account_id')
        ->get();

        // --- Vendor Payments (overall total only) ---
        $totalVendor = Ledger::select(
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Purchase Vendor%' THEN amount ELSE 0 END) as total_cr"),
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Payment To Vendor%' THEN amount ELSE 0 END) as total_dr"),
            \DB::raw("(SUM(CASE WHEN `from` LIKE 'Purchase Vendor%' THEN amount ELSE 0 END) -
                    SUM(CASE WHEN `from` LIKE 'Payment To Vendor%' THEN amount ELSE 0 END)) as due")
        )
        ->first();


        // --- Customer Payments (per account) ---
        $customerPayments = Ledger::select(
            'account_id',
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Sale Customer%' THEN amount ELSE 0 END) as total_dr"),
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Payment Recd From Customer%' THEN amount ELSE 0 END) as total_cr"),
            \DB::raw("(SUM(CASE WHEN `from` LIKE 'Sale Customer%' THEN amount ELSE 0 END) -
                    SUM(CASE WHEN `from` LIKE 'Payment Recd From Customer%' THEN amount ELSE 0 END)) as pending")
        )
        ->groupBy('account_id')
        ->get();

        // --- Customer Payments (overall total only) ---
        $totalCustomer = Ledger::select(
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Sale Customer%' THEN amount ELSE 0 END) as total_dr"),
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Payment Recd From Customer%' THEN amount ELSE 0 END) as total_cr"),
            \DB::raw("(SUM(CASE WHEN `from` LIKE 'Sale Customer%' THEN amount ELSE 0 END) -
                    SUM(CASE WHEN `from` LIKE 'Payment Recd From Customer%' THEN amount ELSE 0 END)) as pending")
        )
        ->first();

       
        $totals = [
            'expense' => (clone $querry)->where('from', 'Expense - Manually')->sum('amount'),
            'income' => (clone $querry)->where('from', 'Income - Manually')->sum('amount'),
            'purchase' => (clone $querry)->where('from', 'Purchase Vendor')->sum('amount'),
            'sale' => (clone $querry)->where('from', 'Sale Customer')->sum('amount'),
            'payment' => (clone $querry)->where('from', 'like', 'Payment To Vendor%')->sum('amount'),
            'received' => (clone $querry)->where('from', 'like', 'Payment Recd From Customer%')->sum('amount'),
        ];
        // Base query with filters
        $query = ManageStock::with('item_detail')
        ->when($request->from_date, function ($q) use ($request) {
            $q->whereDate('manage_stocks.date', '>=', $request->from_date);
        })
        ->when($request->to_date, function ($q) use ($request) {
            $q->whereDate('manage_stocks.date', '<=', $request->to_date);
        });

        // --- Paginated OUT records (sales) with profit per row ---
        $manage_stock = $query->clone()
        ->where('in_out', 'OUT')
        ->whereIn('from', ['Manual','Sale'])
        ->paginate($request->value ?? 50);

        $manage_stock->getCollection()->transform(function ($stock) {
            $selling_price  = $stock->selling_price ?? $stock->item_detail->selling_price;
            $purchase_price = $stock->purchase_price ?? $stock->item_detail->purchase_price;

            // Skip profit if purchase_price is null
            $profit = 0;
            if ($purchase_price !== null) {
                $profit = ($selling_price - $purchase_price) * $stock->quantity;
            }

            $stock->calculated_profit = $profit;
            return $stock;
        });

    // --- Grand Totals ---

    // Total Profit
    $total_profit = $query->clone()
        ->where('in_out', 'OUT')
        ->whereIn('from', ['Manual','Sale'])
        ->get()
        ->sum(function ($stock) {
            $selling_price  = $stock->selling_price ?? $stock->item_detail->selling_price;
            $purchase_price = $stock->purchase_price ?? $stock->item_detail->purchase_price;

            if ($purchase_price === null) {
                return 0; // skip
            }

            return ($selling_price - $purchase_price) * $stock->quantity;
        });

    // Total Purchase (all IN entries)
    $total_purchase = $query->clone()
        ->where('in_out', 'IN')
        ->get()
        ->sum(function ($stock) {
            $purchase_price = $stock->purchase_price ?? $stock->item_detail->purchase_price;

            if ($purchase_price === null) {
                return 0; // skip
            }

            return $purchase_price * $stock->quantity;
        });

    // Total Sale (all OUT entries)
    $total_sale = $query->clone()
        ->where('in_out', 'OUT')
        ->whereIn('from', ['Manual','Sale'])
        ->get()
        ->sum(function ($stock) {
            $selling_price = $stock->selling_price ?? $stock->item_detail->selling_price;
            return $selling_price * $stock->quantity;
        });


        return view('admin.report.profit.datatable',compact('querry','totals','manage_stock','total_profit','total_purchase','total_sale','vendorPayments','customerPayments','totalVendor','totalCustomer'));
    }

    public function datatable(Request $request){
        if($request->from != 'History'){ 
            $title = $request->from;
            $query = AccountMaster::where('from',$title);
            if($request->search){
                $query->where('name','like','%'.$request->search.'%');
            }
            $ledger = $query->orderBy('name','asc')->paginate($request->value ?? 50);
            $ledger->getCollection()->transform(function ($account) {
                // Fetch all debit and credit totals for this account_id
                $totals = Ledger::where('account_id', $account->id)
                ->selectRaw("
                    COALESCE(SUM(CASE WHEN dr_cr = 'Dr' THEN amount END), 0) as total_dr,
                    COALESCE(SUM(CASE WHEN dr_cr = 'Cr' THEN amount END), 0) as total_cr
                ")
                ->first();
                
                $account->total_dr = $totals->total_dr;
                $account->total_cr = $totals->total_cr;
                
                // Balance based on nature
                if (in_array($account->from, ['Vendor', 'Income'])) {
                    // Credit nature
                    $account->remaining = $totals->total_cr - $totals->total_dr;
                } else {
                    // Debit nature
                    $account->remaining = $totals->total_dr - $totals->total_cr;
                }
            
                return $account;
            });
            return view('admin.ledger.datatable',compact('ledger'));
        }
        else{
            $account = AccountMaster::findOrFail($request->account_id);

            $query = Ledger::where('account_id', $account->id)
                ->when($request->search, fn($q) => $q->where('remarks', 'like', '%' . $request->search . '%'))
                ->when($request->from_date, fn($q) => $q->where('date', '>=', $request->from_date))
                ->when($request->to_date, fn($q) => $q->where('date', '<=', $request->to_date));

                $totals = (clone $query)
                ->selectRaw("
                    COALESCE(SUM(CASE WHEN dr_cr = 'Dr' THEN amount END), 0) as total_dr,
                    COALESCE(SUM(CASE WHEN dr_cr = 'Cr' THEN amount END), 0) as total_cr
                ")
                ->first();
            
            $totals->remaining = in_array($account->from, ['Vendor', 'Income'])
                ? $totals->total_cr - $totals->total_dr  // Credit nature
                : $totals->total_dr - $totals->total_cr; // Debit nature

            $ledger = $query->orderBy('date', 'desc')->paginate($request->value ?? 50);
            return view('admin.ledger.show_datatable',compact('ledger','totals'));
        }
      
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
        $ledger = Ledger::find($request->id);
        if(!$ledger){
            $ledger = new Ledger;
            $ledger->user_id = auth()->user()->id;
            $ledger->from = 'Manually';
            $ledger->from_id = 0;
        }
        $ledger->account_id = $request->account_id;
        $ledger->payment_method_id = $request->payment_method_id;
        $ledger->date = $request->date;
        $ledger->amount = $request->amount;
        $ledger->dr_cr = $request->dr_cr;
        $ledger->status = 1;
        $ledger->remarks = $request->remarks;
        $ledger->save();
        $data = [
            'result' => 1,
            'message' => 'Ledger Added Successfully'
        ];
        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account_master = AccountMaster::find($id);
        $payment_master = PaymentMethod::where('status',1)->get();
        return view('admin.ledger.show_index',compact('account_master','payment_master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $ledger = Ledger::find($id);
        $ledger->delete();
        $data = [
            'result' => 1,
            'message' => 'Ledger Deleted Successfully'
        ];
        return $data;
    }
}

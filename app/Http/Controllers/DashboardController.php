<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleOrder;
use App\Models\Ledger;
use App\Models\ManageStock;

class DashboardController extends Controller
{
    public function index()
    {   
        return view('admin.dashboard');
    }

    public function datatable(Request $request){
        $querry = SaleOrder::query();
        if($request->search){
            $querry->where('sale_no','like','%'.$request->search.'%');
        }
        if($request->from_date){
            $querry->where('sale_date','>=',$request->from_date);
        }
        if($request->to_date){
            $querry->where('sale_date','<=',$request->to_date);
        }
        $sale = $querry->latest()->paginate($request->value ?? 50);
        return view('admin.datatable',compact('sale'));
    }

    public function get_wdiget(Request $request){
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
        ->where('from', 'Sale')
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
        ->where('from', 'Sale')
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
        ->where('from', 'Sale')
        ->get()
        ->sum(function ($stock) {
            $selling_price = $stock->selling_price ?? $stock->item_detail->selling_price;
            return $selling_price * $stock->quantity;
        });


        return view('admin.widget',compact('querry','totals','manage_stock','total_profit','total_purchase','total_sale','vendorPayments','customerPayments','totalVendor','totalCustomer'));
    }

   
}

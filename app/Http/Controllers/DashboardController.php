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
        $querry = SaleOrder::with(['account', 'details.item_detail']);
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
        // if($request->from_date){
        //     $querry->where('date','>=',$request->from_date);
        // }
        // if($request->to_date){
        //     $querry->where('date','<=',$request->to_date);
        // }
       // --- Vendor Payments (per account) ---
        $vendorPayments = Ledger::select(
            'account_id',
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Purchase Vendor%' THEN amount ELSE 0 END) as total_cr"),
            \DB::raw("
                SUM(CASE 
                    WHEN `from` LIKE 'Payment To Vendor%' 
                      OR `from` LIKE 'Manually - Vendor%' 
                    THEN amount 
                    ELSE 0 
                END) as total_dr
            "),
            \DB::raw("(
                SUM(CASE WHEN `from` LIKE 'Purchase Vendor%' THEN amount ELSE 0 END) -
                SUM(CASE 
                    WHEN `from` LIKE 'Payment To Vendor%' 
                      OR `from` LIKE 'Manually - Vendor%' 
                    THEN amount 
                    ELSE 0 
                END)
            ) as due")
        )
        ->groupBy('account_id')
        ->get();

        // --- Vendor Payments (overall total only) ---
        $totalVendor = Ledger::select(
            // Credit: vendor payable increases
            \DB::raw("
                SUM(CASE 
                    WHEN (`from` LIKE 'Purchase Vendor%' AND dr_cr = 'Cr')
                      OR (`from` LIKE 'Manually - Vendor%' AND dr_cr = 'Cr')
                      OR (`from` LIKE 'Add More Stock' AND dr_cr = 'Cr')
                    THEN amount 
                    ELSE 0 
                END) as total_cr
            "),
        
            // Debit: vendor payable decreases (payment made)
            \DB::raw("
                SUM(CASE 
                    WHEN (`from` LIKE 'Payment To Vendor%' AND dr_cr = 'Dr')
                      OR (`from` LIKE 'Manually - Vendor%' AND dr_cr = 'Dr')
                    THEN amount 
                    ELSE 0 
                END) as total_dr
            "),
        
            // Remaining due = Cr - Dr
            \DB::raw("
                (
                    SUM(CASE 
                        WHEN (`from` LIKE 'Purchase Vendor%' AND dr_cr = 'Cr')
                          OR (`from` LIKE 'Manually - Vendor%' AND dr_cr = 'Cr')
                        THEN amount 
                        ELSE 0 
                    END)
                    -
                    SUM(CASE 
                        WHEN (`from` LIKE 'Payment To Vendor%' AND dr_cr = 'Dr')
                          OR (`from` LIKE 'Manually - Vendor%' AND dr_cr = 'Dr')
                        THEN amount 
                        ELSE 0 
                    END)
                ) as due
            ")
        )->first();
        


        // --- Customer Payments (per account) ---
        $customerPayments = Ledger::select(
            'account_id',
            \DB::raw("SUM(CASE WHEN `from` LIKE 'Sale Customer%' THEN amount ELSE 0 END) as total_dr"),
            \DB::raw("
                SUM(CASE 
                    WHEN `from` LIKE 'Payment Recd From Customer%' 
                    OR `from` LIKE 'Manually - Customer%' 
                    THEN amount 
                    ELSE 0 
                END) as total_cr
            "),
            \DB::raw("(
                SUM(CASE WHEN `from` LIKE 'Sale Customer%' THEN amount ELSE 0 END) -
                SUM(CASE 
                    WHEN `from` LIKE 'Payment Recd From Customer%' 
                      OR `from` LIKE 'Manually - Customer%' 
                    THEN amount 
                    ELSE 0 
                END)
            ) as pending")
        )
        ->groupBy('account_id')
        ->get();

        // --- Customer Payments (overall total only) ---
        $totalCustomer = Ledger::select(
            // Debit: you are owed money (sale or manual Dr)
            \DB::raw("
                SUM(CASE 
                    WHEN (`from` LIKE 'Sale Customer%' AND dr_cr = 'Dr')
                      OR (`from` LIKE 'Manually - Customer%' AND dr_cr = 'Dr')
                    THEN amount 
                    ELSE 0 
                END) as total_dr
            "),
        
            // Credit: you received money (payment or manual Cr)
            \DB::raw("
                SUM(CASE 
                    WHEN (`from` LIKE 'Payment Recd From Customer%' AND dr_cr = 'Cr')
                      OR (`from` LIKE 'Manually - Customer%' AND dr_cr = 'Cr')
                    THEN amount 
                    ELSE 0 
                END) as total_cr
            "),
        
            // Pending = Dr - Cr
            \DB::raw("
                (
                    SUM(CASE 
                        WHEN (`from` LIKE 'Sale Customer%' AND dr_cr = 'Dr')
                          OR (`from` LIKE 'Manually - Customer%' AND dr_cr = 'Dr')
                        THEN amount 
                        ELSE 0 
                    END)
                    -
                    SUM(CASE 
                        WHEN (`from` LIKE 'Payment Recd From Customer%' AND dr_cr = 'Cr')
                          OR (`from` LIKE 'Manually - Customer%' AND dr_cr = 'Cr')
                        THEN amount 
                        ELSE 0 
                    END)
                ) as pending
            ")
        )->first();
        
       
        $totals = [
            'expense' => (clone $querry)->where('from', 'Expense - Manually')->sum('amount'),
            'income' => (clone $querry)->where('from', 'Income - Manually')->sum('amount'),
            'purchase' => (clone $querry)
            ->where(function ($q) {
                $q->where('from', 'like', 'Purchase Vendor%')
                  ->orWhere('from', 'like', 'Add More Stock');
            })
            ->where('dr_cr','Cr')
            ->sum('amount'),
            'sale' => (clone $querry)->where('from', 'Sale Customer')->sum('amount'),
            'payment' => (clone $querry)
            ->where(function ($q) {
                $q->where('from', 'like', 'Payment To Vendor%')
                  ->orWhere('from', 'like', 'Manually - Vendor%');
            })
            ->where('dr_cr','Dr')
            ->sum('amount'),
            'received' => (clone $querry)
            ->where(function ($q) {
                $q->where('from', 'like', 'Payment Recd From Customer%')
                  ->orWhere('from', 'like', 'Manually - Customer%');
            })
            ->where('dr_cr','Cr')
            ->sum('amount'),
        ];
        // Base query with filters
        $query = ManageStock::with(['item_detail', 'brand', 'category'])
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
                $profit = ($selling_price - $purchase_price) * $stock->quantity - ($stock->discount * $stock->quantity);
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

            return ($selling_price - $purchase_price) * $stock->quantity - ($stock->discount * $stock->quantity);
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
            return $selling_price * $stock->quantity - ($stock->discount * $stock->quantity);
        });


        return view('admin.widget',compact('querry','totals','manage_stock','total_profit','total_purchase','total_sale','vendorPayments','customerPayments','totalVendor','totalCustomer'));
    }
   public function verifyWhatsappWebhook(Request $request)
{
    
    $verify_token = 'HoiseryStockToken'; // same as you entered in Facebook developer settings

    $mode = $request->get('hub_mode');
    $token = $request->get('hub_verify_token');
    $challenge = $request->get('hub_challenge');

    if ($mode === 'subscribe' && $token === $verify_token) {
        return response($challenge, 200);
    } else {
        return response('Forbidden', 403);
    }
}
public function whatsapp_webhook(Request $request)
{
    // Handle incoming WhatsApp messages here
   \Log::info("---- WHATSAPP WEBHOOK START ----");
    \Log::info(json_encode($request->all(), JSON_PRETTY_PRINT));
    \Log::info("---- WHATSAPP WEBHOOK END ----");

    return response('EVENT_RECEIVED', 200);
}

   
}

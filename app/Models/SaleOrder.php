<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','sale_no','sale_date','account_id','total_items','total_quantity','total_sale_amount','total_paid_amount','total_discount','adjusted_amount','total_tax','total_courier','total_net_amount','total_pending_amount','payment_method','status','remarks','deleted_at'];

    public function account(){
        return $this->belongsTo(AccountMaster::class, 'account_id');
    }

    public function details(){
        return $this->hasMany(ManageStock::class, 'from_id')->where('from','Sale');
    }

    public function getPaymentHistoryAttribute()
    {
        return Ledger::where('from', 'Payment Recd From Customer - ' . $this->id)->get();
    }
    public function getProfitAttribute()
{
    $totalProfit = 0;

    foreach ($this->details as $stock) {
        $selling_price  = $stock->selling_price ?? optional($stock->item_detail)->selling_price;
        $purchase_price = $stock->purchase_price ?? optional($stock->item_detail)->purchase_price;
        $discount       = $stock->discount ?? 0;
        $quantity       = $stock->quantity ?? 0;

        if ($purchase_price !== null && $selling_price !== null) {
            $totalProfit += (($selling_price - $purchase_price) * $quantity) - ($discount * $quantity);
        }
    }

    return $totalProfit;
}
}

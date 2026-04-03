<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use HasFactory,SoftDeletes;
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function account(){
        return $this->belongsTo(AccountMaster::class, 'account_id');
    }

    public function getRelatedOrderAttribute()
    {
        if (str_contains($this->from, 'Purchase Vendor') || str_contains($this->from, 'Payment To Vendor')) {
            $order = PurchaseOrder::find($this->from_id);
            if ($order) {
                return (object)[
                    'id'        => $order->id,
                    'order_no'  => $order->purchase_no,
                    'type'      => 'purchase',
                    'from'      => 'Purchase Order',
                    'account_id'      => $order->vendor_id,
                ];
            }
        }
    
        if (str_contains($this->from, 'Sale Customer') || str_contains($this->from, 'Payment Recd From Customer')) {
            $order = SaleOrder::find($this->from_id);
            if ($order) {
                return (object)[
                    'id'        => $order->id,
                    'order_no'  => $order->sale_no,
                    'type'      => 'sale',
                    'from'      => 'Sale Order',
                    'account_id'      => $order->account_id,
                ];
            }
        }
    
        return null;
    }
    
    
    

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['purchase_no','purchase_date','vendor_id','total_items','total_quantity','total_mutha','total_purchase_amount','total_paid_amount','total_pending_amount','payment_method','status','remarks','deleted_at'];

    public function vendor(){
        return $this->belongsTo(AccountMaster::class, 'vendor_id');
    }

    public function details(){
        return $this->hasMany(ItemDetail::class, 'from_id')->where('from','Purchase');
    }

    public function getPaymentHistoryAttribute()
    {
        return Ledger::where('from', 'Payment To Vendor - ' . $this->id)->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['sale_no','sale_date','account_id','total_items','total_quantity','total_sale_amount','total_paid_amount','total_pending_amount','payment_method','status','remarks','deleted_at'];

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
}

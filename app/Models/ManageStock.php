<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageStock extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'from',
        'from_id',
        'date',
        'brand_id',
        'season_id',
        'category_id',
        'purchase_price',
        'selling_price',
        'item_id',
        'item_detail_id',
        'in_out',
        'remarks',
        'quantity',
        'software_remarks',
        'deleted_at',
    ];
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function season(){
        return $this->belongsTo(Season::class, 'season_id');
    }
    public function item_detail(){
        return $this->belongsTo(ItemDetail::class, 'item_detail_id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function sale(){
        return $this->belongsTo(SaleOrder::class, 'from_id');
    }
    public function purchase(){
        return $this->belongsTo(PurchaseOrder::class, 'from_id');
    }
    
}

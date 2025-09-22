<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'from',
        'from_id',
        'brand_id',
        'category_id',
        'season_id',
        'total_items',
        'min_alert',
        'max_alert',
        'size_list',
        'color_list',
        'purchase_price_list',
        'selling_price_list',
        'total_purchase_amount',
        'total_sale_amount',
        'total_stock',
        'pending_stock',
        'total_profit',
        'actual_profit',
        'image',
        'status',
        'is_temp',
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
    public function details()
    {
        return $this->hasMany(ItemDetail::class, 'item_id');
    }
}

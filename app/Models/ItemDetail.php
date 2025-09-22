<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'from',
        'from_id',
        'item_id',
        'brand_id',
        'category_id',
        'season_id',
        'article_name',
        'barcode_value',
        'size',
        'color',
        'quantity',
        'mutha',
        'purchase_price',
        'selling_price',
        'total_stock',
        'opening_stock',
        'pending_stock',
        'total_purchse_value',
        'total_sale_value',
        'result_sale_amount',
        'result_profit_amount',
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
    public function getRemainingStockAttribute()
{
    $result = ManageStock::where('item_detail_id', $this->id)
        ->select(\DB::raw('SUM(CASE WHEN in_out IN ("In", "GR") THEN quantity ELSE -quantity END) AS remaining_stock'))
        ->first();

    return $result->remaining_stock ?? 0;
}
}

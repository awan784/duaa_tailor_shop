<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use SoftDeletes;
    protected $table = 'stocks';
    protected $fillable = ['name', 'quantity', 'purchase_price', 'sub_category','ware_house', 'sale_price', 'sku', 'category_id', 'unit_id', 'date', 'detail','images', 'expense'];

    public function category()
    {
        return $this->belongsTo(StockCategory::class, 'category_id');
    }
    public function unit()
    {
        return $this->belongsTo(StockUnit::class, 'unit_id');
    }
    public function sale_quantity()
    {
        return Sale::selectRaw('SUM(
            JSON_UNQUOTE(JSON_EXTRACT(products, CONCAT("$[", seq.n - 1, "].quantity")))
        ) as total_quantity')
        ->crossJoin(DB::raw('(SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) seq'))
        ->whereRaw('JSON_EXTRACT(products, CONCAT("$[", seq.n - 1, "].product_id")) = ?', [$this->id])
        ->value('total_quantity') ?? 0;
    }

    public function remaining_quantity()
    {
        return $this->quantity;
        // $totalSold = $this->sale_quantity();
        // $totalSold = $totalSold ?? 0;
        // return $this->quantity - $totalSold;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockSubCategory extends Model
{
    use SoftDeletes;
    protected $table = 'stock_sub_category';
    protected $fillable = ['cat_id','name'];
}

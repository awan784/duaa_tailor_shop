<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockUnit extends Model
{
    use SoftDeletes;
    protected $table = 'stock_units';
    protected $fillable = ['name'];
}

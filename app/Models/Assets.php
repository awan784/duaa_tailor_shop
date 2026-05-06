<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Assets extends Model
{
    use SoftDeletes;
    protected $table = 'assets';
    protected $fillable = ['name', 'qty', 'price', 'purchase_date'];


}

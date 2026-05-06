<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class AssetsUsed extends Model
{
    use SoftDeletes;
    protected $table = 'assets_used';
    protected $fillable = ['assets_id' , 'qty' , 'used_date'];
  
    public function assets()
    {
        return $this->belongsTo(Assets::class);
    }


}

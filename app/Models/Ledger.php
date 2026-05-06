<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use SoftDeletes;
    protected $table = 'ledgers';
    protected $fillable = ['total_price', 'customer_id', 'customer_type', 'transaction_type', 'sale_id', 'amount', 'detail'];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}

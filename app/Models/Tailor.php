<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tailor extends Model
{
    use SoftDeletes;
    protected $table = 'tailors';
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'tailor_id');
    }
    public function ledgers(){
        return $this->hasMany(Ledger::class, 'customer_id')->where('customer_type','tailor');
    }
    public function getAccountSummaryAttribute()
    {
        $debit = $this->ledgers()->where('transaction_type', 'debit')->sum('amount');
        $credit = $this->ledgers()->where('transaction_type', 'credit')->sum('amount');
        $remaining = $credit - $debit;

        return [
            'debit' => $debit,
            'credit' => $credit,
            'remaining' => $remaining,
        ];
    }
}

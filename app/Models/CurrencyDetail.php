<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyDetail extends Model
{
    use HasFactory;

    public $table = 'currency_detail';
    public function moneyChanger() {
        return $this->belongsTo(MoneyChanger::class,'moneyChangerId');
    }

    public function currency() {
        return $this->belongsTo(Currency::class,'currencyId');
    }
}

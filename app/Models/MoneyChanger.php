<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MoneyChanger extends Model
{
    use HasApiTokens, HasFactory;

    public $table = 'money_changer';

    public function officeHourDetail() {
        return $this->hasMany(OfficeHourDetail::class);
    }
}

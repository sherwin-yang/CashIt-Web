<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeHourDetail extends Model
{
    use HasFactory;

    public $table = 'office_hour_detail';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function officeHour() {
        return $this->belongsTo(OfficeHour::class);
    }

    public function moneyChanger() {
        return $this->belongsTo(MoneyChanger::class);
    }
}

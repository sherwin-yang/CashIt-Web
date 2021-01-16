<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeHour extends Model
{
    use HasFactory;

    public $table = 'office_hour';

    public function officeHourDetail() {
        return $this->hasOne(OfficeHourDetail::class);
    }
}

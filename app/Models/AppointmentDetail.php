<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    use HasFactory;

    public $table = 'appointment_detail';

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function currencyDetail() {
        return $this->belongsTo(CurrencyDetail::class);
    }
}

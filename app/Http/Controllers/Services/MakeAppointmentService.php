<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakeAppointmentService {
    public function saveAppointmentData(Request $request, $newAppointment, $newAppointmentDetail) {
        $appointmentDate = $request->date;
        $moneyChangerId = $request->moneyChangerId;
        $orderNumber = $this->countNumberOfAppointment($appointmentDate, $moneyChangerId);

        $newAppointment->orderNumber = $appointmentDate."-".$orderNumber;
        $newAppointment->status = 'ongoing';
        $newAppointment->date = $appointmentDate;
        $newAppointment->time = $request->time;
        $newAppointment->toExchangeAmount = $request->toExchangeAmount;
        $newAppointment->toExchangeCurrencyName = $request->toExchangeCurrencyName;
        $newAppointment->toReceiveAmount = $request->toReceiveAmount;
        $newAppointment->toReceiveCurrencyName = $request->toReceiveCurrencyName;
        $newAppointment->save();
        $this->saveAppointmentDetailData($request, $newAppointmentDetail, $newAppointment->id);

        return $newAppointment;
    }

    private function saveAppointmentDetailData(Request $request, $newAppointmentDetail, $newAppointmentId) {
        $newAppointmentDetail->userId = $request->userId;
        $newAppointmentDetail->appointmentId = $newAppointmentId;
        $newAppointmentDetail->moneyChangerId = $request->moneyChangerId;
        $newAppointmentDetail->save();
    }

    private function countNumberOfAppointment($appointmentDate, Int $moneyChangerId) {
        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment.id', '=', 'appointment_detail.appointmentId')
        ->join('money_changer', 'appointment_detail.moneyChangerId', 'money_changer.id')
        ->where('money_changer.id', $moneyChangerId)
        ->where('appointment.date', $appointmentDate)
        ->get();

        $numberOfAppointment = count($appointments)+1;

        return $numberOfAppointment;
    }
}

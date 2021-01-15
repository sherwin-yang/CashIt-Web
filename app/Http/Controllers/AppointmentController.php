<?php

namespace App\Http\Controllers;

use App\Models\AppointmentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Expr\Cast\Int_;

class AppointmentController extends Controller
{

    public function getListOfAppointmentByMoneyChangerId() {
        if(!session()->has('user_id')) {
            return redirect('login');
        }

        $appointments = $this->getListOfAppointmentDetailByMoneyChangerId();

        return view('main-view/mc_appointment', ['appointments'=>$appointments]);
    }

    private function getListOfAppointmentDetailByMoneyChangerId() {
        $moneyChangerId = session()->get('user_id');
        date_default_timezone_set('Asia/Jakarta');
        $todayDate = Date('y-m-d');

        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment.id', '=', 'appointment_detail.appointmentId')
        ->join('user', 'appointment_detail.userId', '=', 'user.id')
        ->join('currency_detail', 'appointment_detail.toReceiveCurrencyDetailId', '=', 'currency_detail.id')
        ->join('currency', 'currency_detail.id', '=', 'currency.id')
        ->join('money_changer', 'currency_detail.moneyChangerId', 'money_changer.id')
        ->select('appointment.*', 'user.userName', 'currency.currencyName')
        ->where('money_changer.id', $moneyChangerId)
        ->where('appointment.date', $todayDate)
        ->get();

        return $appointments;
    }

    /*
    |--------------------------------------------------------------------------
    | API's
    |--------------------------------------------------------------------------
    */

    public function makeNewAppointment(Request $request) {
        $appointmentDate = $request->date;
        $moneyChangerId = $request->moneyChangerId;
        $numberOfOrders = $this->countNumberOfAppointment($request, $moneyChangerId);

        $appointment = $this->saveAppointmentData($request, $appointmentDate, $numberOfOrders);

        $response = [
            'Appointment' => $appointment
        ];

        return response($response);
    }

    private function saveAppointmentData(Request $request, $appointmentDate, $queueNumber) {
        $newAppointment = new Appointment();
        $newAppointment->orderNumber = $appointmentDate."-".$queueNumber;
        $newAppointment->status = 'ongoing';
        $newAppointment->date = $appointmentDate;
        $newAppointment->time = $request->time;
        $newAppointment->toExchangeAmount = $request->toExchangeAmount;
        $newAppointment->save();
        $this->saveAppointmentDetailData($request, $newAppointment->id);

        return $newAppointment;
    }

    private function saveAppointmentDetailData(Request $request, Int $newAppointmentId) {
        $newAppointmentDetail = new AppointmentDetail();
        $newAppointmentDetail->userId = $request->userId;
        $newAppointmentDetail->appointmentId = $newAppointmentId;
        $newAppointmentDetail->toExchangeCurrencyName = $request->toExchangeCurrencyName;
        $newAppointmentDetail->toReceiveCurrencyDetailId = $request->toReceiveCurrencyDetailId;
        $newAppointmentDetail->save();
    }

    private function countNumberOfAppointment(Request $request, Int $moneyChangerId) {
        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment.id', '=', 'appointment_detail.appointmentId')
        ->join('user', 'appointment_detail.userId', '=', 'user.id')
        ->join('currency_detail', 'appointment_detail.toReceiveCurrencyDetailId', '=', 'currency_detail.id')
        ->join('currency', 'currency_detail.id', '=', 'currency.id')
        ->join('money_changer', 'currency_detail.moneyChangerId', 'money_changer.id')
        ->select('appointment.*', 'user.userName', 'currency.currencyName')
        ->where('money_changer.id', $moneyChangerId)
        ->where('appointment.date', $request->date)
        ->get();

        $numberOfAppointment = count($appointments)+1;

        return $numberOfAppointment;
    }

}

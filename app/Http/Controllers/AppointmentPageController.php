<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\AppointmentDetail;

class AppointmentPageController extends Controller
{
    public function showAppointments() {
        if(!session()->has('user')) {
            return redirect('login');
        }

        if(session()->get('role') == 'admin') {
            return redirect()->route('admin');
        }

        if(session()->get('user.isActivated') == false) {
            return redirect()->route('revision');
        }

        $appointments = $this->getListOfAppointmenByMoneyChangerId();
        return view('main-view/mc_appointment', ['appointments'=>$appointments]);
    }

    private function getListOfAppointmenByMoneyChangerId() {
        $moneyChangerId = session()->get('user.id');
        date_default_timezone_set('Asia/Jakarta');
        $todayDate = Date('y-m-d');

        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment.id', '=', 'appointment_detail.appointmentId')
        ->join('user', 'appointment_detail.userId', '=', 'user.id')
        ->join('money_changer', 'appointment_detail.moneyChangerId', 'money_changer.id')
        ->select('appointment.*', 'user.userName')
        ->where('appointment.status', 'ongoing')
        ->where('money_changer.id', $moneyChangerId)
        ->where('appointment.date', '>=', $todayDate)
        ->orderBy('appointment.orderNumber', 'asc')
        ->get();

        return $appointments;
    }

    public function finishAppointment(Request $request) {
        if($request->button == 'selesaikan') {
            $appointment = Appointment::find($request->appointmentId);
            $appointment->status = 'completed';
            $appointment->save();
        }

        return redirect()->route('appointment');
    }

    /*
    |--------------------------------------------------------------------------
    | API's
    |--------------------------------------------------------------------------
    */

    public function makeNewAppointment(Request $request) {
        $appointmentDate = $request->date;
        $moneyChangerId = $request->moneyChangerId;
        $numberOfOrders = $this->countNumberOfAppointment($appointmentDate, $moneyChangerId);

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
        $newAppointment->toExchangeCurrencyName = $request->toExchangeCurrencyName;
        $newAppointment->toReceiveAmount = $request->toReceiveAmount;
        $newAppointment->toReceiveCurrencyName = $request->toReceiveCurrencyName;
        $newAppointment->save();
        $this->saveAppointmentDetailData($request, $newAppointment->id);

        return $newAppointment;
    }

    private function saveAppointmentDetailData(Request $request, Int $newAppointmentId) {
        $newAppointmentDetail = new AppointmentDetail();
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

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

        $appointments = $this->getListOfAppointmentByMoneyChangerId();
        return view('main-view/mc_appointment', ['appointments'=>$appointments]);
    }

    private function getListOfAppointmentByMoneyChangerId() {
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

}

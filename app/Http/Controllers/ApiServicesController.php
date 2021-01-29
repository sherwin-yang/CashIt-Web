<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Services\MakeAppointmentService;
use App\Models\MoneyChanger;

class ApiServicesController extends Controller
{

    /*
    ---------- Login ----------
    */
    public function customerLogin(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Credential does not match or user has not been registered']
            ], 404);
        }

        // $token = $user->createToken('my-app-token')->plainTextToken;

        // $response = [
        //     $user
        // ];

        return response()->json($user);
    }

    /*
    ---------- Register ----------
    */
    public function registerCustomer(Request $request) {
        $newUser = new User();
        $newUser->userName = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();
    }

    /*
    ---------- Get Money Changer By Currency ----------
    */
    public function getMoneyChangerByTo_ExchangReceive(Request $request) {
        $toExchange = $request->toExchangeCurrencyName;
        $toReceive = $request->toReceiveCurrencyName;

        $result = DB::table('money_changer')
        ->join('currency_detail', 'currency_detail.moneyChangerId', '=', 'money_changer.id')
        ->join('currency', 'currency.id', '=', 'currency_detail.currencyId')
        ->select('money_changer.*')
        ->where('currency.currencyName', $toExchange)
        ->get();

        return response($result);
    }

    /*
    ---------- Get Currency By Money Changer Id ----------
    */
    public function getCurrencyByMoneyChangerId(Request $request) {
        $currencies = DB::table('currency')
        ->join('currency_detail', 'currency_detail.currencyId', '=', 'currency.id')
        ->join('money_changer', 'currency_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('currency.*')
        ->where('money_changer.id', $request->moneyChangerId)
        ->get();

        return $currencies;
    }

    /*
    ---------- Office Hour By Money Changer Id ----------
    */
    public function getOfficeHourByMoneyChangerId(Request $request) {
        $officeHour = DB::table('office_hour')
        ->join('office_hour_detail', 'office_hour.id', '=', 'office_hour_detail.officeHourId')
        ->join('money_changer', 'office_hour_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('office_hour.*')
        ->where('money_changer.id', $request->moneyChangerId)
        ->get();

        return $officeHour;
    }

    /*
    ---------- Get Reviews ----------
    */
    public function getAllReviewsByMoneyChangerId(Request $request) {
        $result = DB::table('review')
        ->join('appointment_detail', 'appointment_detail.id', '=', 'review.appointmentDetailId')
        ->join('money_changer', 'appointment_detail.moneyChangerId', '=', 'money_changer.id')
        ->where('money_changer.id', $request->moneyChangerId)
        ->get();

        return response($result);
    }

    public function getUserFilteredByReviews(Request $request) {
        $result = DB::table('review')
        ->join('appointment_detail', 'appointment_detail.id', '=', 'review.appointmentDetailId')
        ->join('user', 'appointment_detail.userId', '=', 'user.id')
        ->where('money_changer.id', $request->moneyChangerId)
        ->get();

        return response($result);
    }

    /*
    ---------- Make Appointment ----------
    */
    public function makeNewAppointment(Request $request) {
        $newAppointment = new Appointment();
        $newAppointmentDetail = new AppointmentDetail();
        $service = new MakeAppointmentService();
        $service->saveAppointmentData($request, $newAppointment, $newAppointmentDetail);
    }

    /*
    ---------- Get All Money Changer ----------
    */
    public function getAllMoneyChanger() {
        $allMoneyChanger = MoneyChanger::all();
        return response($allMoneyChanger);
    }

    /*
    ---------- Get Appointment ----------
    */
    public function getAppointmentsByUserId(Request $request) {
        $userId = $request->userId;
        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment_detail.appointmentId', '=', 'appointment.id')
        ->join('money_changer', 'money_changer.id', '=', 'appointment_detail.moneyChangerId')
        ->select('appointment.*')
        ->where('appointment_detail.userId', $userId)
        ->get();

        return response($appointments);
    }

    public function getMoneyChangerFilteredByAppointment(Request $request) {
        $userId = $request->userId;
        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment_detail.appointmentId', '=', 'appointment.id')
        ->join('money_changer', 'money_changer.id', '=', 'appointment_detail.moneyChangerId')
        ->select('money_changer.*')
        ->groupBy('money_changer.id')
        ->where('appointment_detail.userId', $userId)
        ->get();

        return response($appointments);
    }

    public function getAppointmentDetailFilteredByAppointment(Request $request) {
        $userId = $request->userId;
        $appointments = DB::table('appointment_detail')
        ->select('appointment_detail.*')
        ->where('appointment_detail.userId', $userId)
        ->get();

        return response($appointments);
    }
}

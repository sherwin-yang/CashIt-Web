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
use App\Models\Review;
use CreateReviewTable;

class ApiServicesController extends Controller
{

    /*
    ---------- Login ----------
    */
    public function customerLogin(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                ['Credential does not match or user has not been registered']
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
        if(!$request->name || !$request->email || $request->password) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        $newUser = new User();
        $newUser->userName = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        return response('Registration Success!');
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
        ->where(['currency.currencyName' => $toReceive, 'currency.currencyName' => $toExchange])
        ->groupBy("money_changer.id")
        ->get();

        $rs = [];
        foreach($result as $r) {
            $rs[] = $r->id;
        }

        $response = [
            "mc" => $result,
            "id" => $rs
        ];

        return response($response);
    }

    /*
    ---------- Get Currency By Money Changer Id ----------
    */
    public function getCurrencyByMoneyChangerId($id) {
        if(!$id) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        $currencies = DB::table('currency')
        ->join('currency_detail', 'currency_detail.currencyId', '=', 'currency.id')
        ->join('money_changer', 'currency_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('currency.*')
        ->where('money_changer.id', $id)
        ->get();

        return response($currencies);
    }

    /*
    ---------- Office Hour By Money Changer Id ----------
    */
    public function getOfficeHourByMoneyChangerId($id) {
        if(!$id) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        $officeHour = DB::table('office_hour')
        ->join('office_hour_detail', 'office_hour.id', '=', 'office_hour_detail.officeHourId')
        ->join('money_changer', 'office_hour_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('office_hour.*')
        ->where('money_changer.id', $id)
        ->get();

        return response($officeHour);
    }

    /*
    ---------- Get Reviews ----------
    */
    public function getAllReviewsByMoneyChangerId($id) {
        if(!$id) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        $reviews = DB::table('review')
        ->join('appointment_detail', 'appointment_detail.id', '=', 'review.appointmentDetailId')
        ->join('user', 'user.id', '=', 'appointment_detail.userId')
        ->join('money_changer', 'appointment_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('user.userName', 'review.rating', 'rating.description', 'rating.date')
        ->where('money_changer.id', $id)
        ->get();

        return response($reviews);
    }

    /*
    ---------- Make Appointment ----------
    */
    public function makeNewAppointment(Request $request) {
        if(!$request->moneyChangerId ||
        !$request->date ||
        !$request->time ||
        !$request->toExchangeAmount ||
        !$request->toExchangeCurrencyName ||
        !$request->toReceiveAmount ||
        !$request->toReceiveCurrencyName ||
        !$request->userId) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        $newAppointment = new Appointment();
        $newAppointmentDetail = new AppointmentDetail();
        $this->saveAppointmentData($request, $newAppointment, $newAppointmentDetail);

        return response('Appointment Saved!');
    }

    private function saveAppointmentData(Request $request, $newAppointment, $newAppointmentDetail) {
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

    /*
    ---------- Get All Money Changer ----------
    */
    public function getAllMoneyChanger() {
        $allMoneyChanger = MoneyChanger::where('isActivated', true)->get();
        return response($allMoneyChanger);
    }

    /*
    ---------- Get Appointment ----------
    */
    public function getAppointmentsByUserId($id) {
        if(!$id) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        $this->changePastAppointmentStatus($id);

        $appointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment_detail.appointmentId', '=', 'appointment.id')
        ->join('money_changer', 'money_changer.id', '=', 'appointment_detail.moneyChangerId')
        ->select('appointment.*', 'money_changer.moneyChangerName', 'money_changer.address')
        ->where('appointment_detail.userId', $id)
        ->get();

        return response()->json($appointments);
    }

    private function changePastAppointmentStatus($id) {
        $allAppointments = DB::table('appointment')
        ->join('appointment_detail', 'appointment_detail.appointmentId', '=', 'appointment.id')
        ->select('appointment.*')
        ->where('appointment_detail.userId', $id)
        ->get();

        date_default_timezone_set('Asia/Jakarta');
        $todayDate = date("Y-m-d");

        // $decodedAppointments = json_decode($allAppointments);

        for ($i = 0; $i < count($allAppointments); $i++) {
            $appointmentStatus = trim(json_encode($allAppointments[$i]->status), '"');
            if($appointmentStatus == "ongoing") {
                $appointmentDate = trim(json_encode($allAppointments[$i]->date), '"');
                if($appointmentDate < $todayDate) {
                    $appointment = Appointment::find(json_encode($allAppointments[$i]->id));
                    $appointment->status = "cancelled";
                    $appointment->save();
                }
            }
        }
    }

    public function giveReview(Request $request) {
        if(!$request->appointmentId ||
        !$request->rating ||
        !$request->description) {
            return response([
                ['Request sent incompleted or does not match with request name']
            ], 404);
        }

        date_default_timezone_set('Asia/Jakarta');
        $todayDate = date("y-m-d");

        $newReview = new Review();
        $newReview->appointmentDetailId = $this->getAppointmentDetailIdByAppointmentId($request->appointmentId);
        $newReview->rating = $request->rating;
        $newReview->description = $request->description;
        $newReview->date = $todayDate;
        $newReview->save();
        $this->changeAppointmentStatus($request->appointmentId);

        return response('Review Saved!');
    }

    private function getAppointmentDetailIdByAppointmentId($appointmentId) {
        $appointmentDetailId = AppointmentDetail::where('appointmentId', $appointmentId)->first();
        return $appointmentDetailId->id;
    }

    private function changeAppointmentStatus($appointmentId) {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = "reviewed";
        $appointment->save();
    }
}

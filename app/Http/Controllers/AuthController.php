<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MoneyChanger;
use App\Models\OfficeHour;
use App\Models\OfficeHourDetail;
use Brick\Math\BigInteger;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Auth for Money Changer
    |--------------------------------------------------------------------------
    */

    public function webUserLogin(Request $request) {
        $user = MoneyChanger::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return view('other-views.mc_login');
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        $request->session()->put('user_id', $user['id']);

        return redirect()->route('appointment');
    }

    public function logOut() {
        if(session()->has('user_id')) {
            session()->pull('user_id');
        }
        return redirect('login');
    }

    public function signUpNewMoneyChanger(Request $request) {
        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|confirmed',
            'address' => 'required|min:12',
            'whatsAppNumber' => 'required|min:10|max:13',
            'phoneNumber' => 'required|min:8|max:10'
        ]);

        $moneyChanger = $this->saveMoneyChangerData($request);
        $this->saveOfficeHourData($request, $moneyChanger);

        return view('other-views.mc_login');
    }

    public function saveMoneyChangerData(Request $request) {
        $newMoneyChanger = new MoneyChanger();
        $newMoneyChanger->name = $request->name;
        $newMoneyChanger->email = $request->email;
        $newMoneyChanger->password = Hash::make($request->password);
        $newMoneyChanger->photo = base64_encode($request->photo);
        $newMoneyChanger->address = $request->address;
        $newMoneyChanger->whatsAppLink = "https://wa.me/".$request->whatsAppNumber;
        $newMoneyChanger->phoneNumber = $request->phoneNumber;
        $newMoneyChanger->activationStatus = "active";
        $newMoneyChanger->save();
        return $newMoneyChanger;
    }

    public function saveOfficeHourData(Request $request, MoneyChanger $moneyChanger) {
        $mondayOfficeHour = new OfficeHour();
        $mondayOfficeHour->day = 'Monday';
        $mondayOfficeHour->openTime = $request->seninOpen;
        $mondayOfficeHour->closeTime = $request->seninClose;
        $mondayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChanger, $mondayOfficeHour);
        $tuesdayOfficeHour = new OfficeHour();
        $tuesdayOfficeHour->day = 'Tuesday';
        $tuesdayOfficeHour->openTime = $request->selasaOpen;
        $tuesdayOfficeHour->closeTime = $request->selasaClose;
        $tuesdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChanger, $tuesdayOfficeHour);
        $wednesdayOfficeHour = new OfficeHour();
        $wednesdayOfficeHour->day = 'Wednesday';
        $wednesdayOfficeHour->openTime = $request->rabuOpen;
        $wednesdayOfficeHour->closeTime = $request->rabuClose;
        $wednesdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChanger, $wednesdayOfficeHour);
        $thursdayOfficeHour = new OfficeHour();
        $thursdayOfficeHour->day = 'Thursday';
        $thursdayOfficeHour->openTime = $request->kamisOpen;
        $thursdayOfficeHour->closeTime = $request->kamisClose;
        $thursdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChanger, $thursdayOfficeHour);
        $fridayOfficeHour = new OfficeHour();
        $fridayOfficeHour->day = 'Friday';
        $fridayOfficeHour->openTime = $request->jumatOpen;
        $fridayOfficeHour->closeTime = $request->jumatClose;
        $fridayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChanger, $fridayOfficeHour);
    }

    public function saveOfficeHourDetailData(MoneyChanger $moneyChanger, OfficeHour $officeHour) {
        $newOfficeHourDetail = new OfficeHourDetail();
        $newOfficeHourDetail->officeHourId = $officeHour->id;
        $newOfficeHourDetail->moneyChangerId = $moneyChanger->id;
        $newOfficeHourDetail->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Auth for Admin
    |--------------------------------------------------------------------------
    */

    // private function checkIsAdminOrMoneyChanger(Request $request) {
    //     if(MoneyChanger::where('email', $request->email)->first()) {
    //         return 'mc';
    //     }
    //     else if(User::where('email', $request->email)->first()) {
    //         $user = User::where('email', $request->email)->first();
    //         if($user->role == 'admin') {
    //             return 'admin';
    //         }
    //     }
    // }

    // public function webUserLogin(Request $request) {
    //     $user = '';
    //     $mc_or_admin = $this->checkIsAdminOrMoneyChanger($request);
    //     if($mc_or_admin == 'mc') {
    //         $user = MoneyChanger::where('email', $request->email)->first();
    //     }
    //     else if($mc_or_admin == 'admin') {
    //         $user = User::where('email', $request->email)->first();
    //     }

    //     if(!$user || !Hash::check($request->password, $user->password)) {
    //         return response([
    //             'message' => ['Credential does not match or user has not been registered']
    //         ], 404);
    //     }

    //     $token = $user->createToken('my-app-token')->plainTextToken;

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];

    //     if($mc_or_admin == 'mc') {
    //         return view('main-view.mc_appointment');
    //     }
    //     else if($mc_or_admin == 'admin') {
    //         return view('main-view.mc_currency');
    //     }
    // }

    /*
    |--------------------------------------------------------------------------
    | Auth for Customer
    |--------------------------------------------------------------------------
    */

    public function customerLogin(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Credential does not match or user has not been registered']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

}

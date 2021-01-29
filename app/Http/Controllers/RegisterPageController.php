<?php

namespace App\Http\Controllers;

use App\Models\MoneyChanger;
use App\Models\OfficeHour;
use App\Models\OfficeHourDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterPageController extends Controller
{
    public function navigateToRegisterPage() {
        if(session()->has('user.id')) {
            return redirect('appointment');
        }
        return view('other-views/mc_register');
    }

    public function signUpNewMoneyChanger(Request $request) {
        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|confirmed',
            'address' => 'required|min:12',
            'whatsAppNumber' => 'required|min:10|max:13',
        ]);

        $this->saveMoneyChangerData($request);

        echo '<script language="javascript"> alert("Registrasi Berhasil!") </script>';
        return view('other-views.login');
    }

    private function saveMoneyChangerData(Request $request) {
        $newMoneyChanger = new MoneyChanger();
        $newMoneyChanger->moneyChangerName = $request->name;
        $newMoneyChanger->email = $request->email;
        $newMoneyChanger->password = Hash::make($request->password);
        $newMoneyChanger->photo = base64_encode($request->photo);
        $newMoneyChanger->address = $request->address;
        $newMoneyChanger->whatsAppNumber = $request->whatsAppNumber;
        $newMoneyChanger->phoneNumber = $request->phoneNumber;
        $newMoneyChanger->isActivated = false;
        $newMoneyChanger->save();
        $this->saveOfficeHourData($request, $newMoneyChanger->id);
    }

    private function saveOfficeHourData(Request $request, Int $moneyChangerId) {
        $mondayOfficeHour = new OfficeHour();
        $mondayOfficeHour->day = 'Monday';
        $mondayOfficeHour->openTime = $request->seninOpen;
        $mondayOfficeHour->closeTime = $request->seninClose;
        $mondayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $mondayOfficeHour->id);
        $tuesdayOfficeHour = new OfficeHour();
        $tuesdayOfficeHour->day = 'Tuesday';
        $tuesdayOfficeHour->openTime = $request->selasaOpen;
        $tuesdayOfficeHour->closeTime = $request->selasaClose;
        $tuesdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $tuesdayOfficeHour->id);
        $wednesdayOfficeHour = new OfficeHour();
        $wednesdayOfficeHour->day = 'Wednesday';
        $wednesdayOfficeHour->openTime = $request->rabuOpen;
        $wednesdayOfficeHour->closeTime = $request->rabuClose;
        $wednesdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $wednesdayOfficeHour->id);
        $thursdayOfficeHour = new OfficeHour();
        $thursdayOfficeHour->day = 'Thursday';
        $thursdayOfficeHour->openTime = $request->kamisOpen;
        $thursdayOfficeHour->closeTime = $request->kamisClose;
        $thursdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $thursdayOfficeHour->id);
        $fridayOfficeHour = new OfficeHour();
        $fridayOfficeHour->day = 'Friday';
        $fridayOfficeHour->openTime = $request->jumatOpen;
        $fridayOfficeHour->closeTime = $request->jumatClose;
        $fridayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $fridayOfficeHour->id);
        $saturdayOfficeHour = new OfficeHour();
        $saturdayOfficeHour->day = 'Saturday';
        $saturdayOfficeHour->openTime = $request->sabtuOpen;
        $saturdayOfficeHour->closeTime = $request->sabtuClose;
        $saturdayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $saturdayOfficeHour->id);
        $sundayOfficeHour = new OfficeHour();
        $sundayOfficeHour->day = 'Sunday';
        $sundayOfficeHour->openTime = $request->mingguOpen;
        $sundayOfficeHour->closeTime = $request->mingguClose;
        $sundayOfficeHour->save();
        $this->saveOfficeHourDetailData($moneyChangerId, $sundayOfficeHour->id);
    }

    private function saveOfficeHourDetailData(Int $moneyChangerId, Int $officeHourId) {
        $newOfficeHourDetail = new OfficeHourDetail();
        $newOfficeHourDetail->officeHourId = $officeHourId;
        $newOfficeHourDetail->moneyChangerId = $moneyChangerId;
        $newOfficeHourDetail->save();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MoneyChanger;
use App\Models\OfficeHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditProfilePageController extends Controller
{
    public function showMoneyChangerInfo() {
        if(!session()->has('user')) {
            return redirect('login');
        }

        if(session()->get('user.isActivated') == true) {
            return redirect()->route('appointment');
        }

        $moneyChangerId = session()->get('user.id');

        $officeHours = DB::table('office_hour')
        ->join('office_hour_detail', 'office_hour.id', '=', 'office_hour_detail.officeHourId')
        ->join('money_changer', 'office_hour_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('office_hour.*')
        ->where('money_changer.id', $moneyChangerId)
        ->get();

        return view('other-views.mc_edit_profile', ['officeHours'=>$officeHours]);
    }

    public function updateMoneyChanger(Request $request) {
        if($request->button == 'ubah') {
            $moneyChanger = MoneyChanger::find(session()->get('user.id'));
            $moneyChanger->moneyChangerName = $request->name;
            $moneyChanger->address = $request->address;
            $moneyChanger->whatsAppNumber = $request->whatsAppNumber;
            $moneyChanger->phoneNumber = $request->phoneNumber;
            $moneyChanger->save();
            session()->put('user', $moneyChanger);
            $this->updateOfficeHour($request);
            $officeHour = $this->getOfficeHour($moneyChanger->id);
            $request->session()->put('openTime', $officeHour->openTime);
            $request->session()->put('closeTime', $officeHour->closeTime);
            echo '<script language="javascript"> alert("Pembaruan berhasil dikirim!") </script>';
        }
        return redirect()->route('revision');
    }

    private function updateOfficeHour(Request $request) {
        $mondayOfficeHour = OfficeHour::find($request->MondayId);
        $mondayOfficeHour->openTime = $request->MondayOpen;
        $mondayOfficeHour->closeTime = $request->MondayClose;
        $mondayOfficeHour->save();
        $tuesdayOfficeHour = OfficeHour::find($request->TuesdayId);
        $tuesdayOfficeHour->openTime = $request->TuesdayOpen;
        $tuesdayOfficeHour->closeTime = $request->TuesdayClose;
        $tuesdayOfficeHour->save();
        $wednesdayOfficeHour = OfficeHour::find($request->WednesdayId);
        $wednesdayOfficeHour->openTime = $request->WednesdayOpen;
        $wednesdayOfficeHour->closeTime = $request->WednesdayClose;
        $wednesdayOfficeHour->save();
        $thursdayOfficeHour = OfficeHour::find($request->ThursdayId);
        $thursdayOfficeHour->openTime = $request->ThursdayOpen;
        $thursdayOfficeHour->closeTime = $request->ThursdayClose;
        $thursdayOfficeHour->save();
        $fridayOfficeHour = OfficeHour::find($request->FridayId);
        $fridayOfficeHour->openTime = $request->FridayOpen;
        $fridayOfficeHour->closeTime = $request->FridayClose;
        $fridayOfficeHour->save();
        $saturdayOfficeHour = OfficeHour::find($request->SaturdayId);
        $saturdayOfficeHour->openTime = $request->SaturdayOpen;
        $saturdayOfficeHour->closeTime = $request->SaturdayClose;
        $saturdayOfficeHour->save();
        $sundayOfficeHour = OfficeHour::find($request->SundayId);
        $sundayOfficeHour->openTime = $request->SundayOpen;
        $sundayOfficeHour->closeTime = $request->SundayClose;
        $sundayOfficeHour->save();
    }

    private function getOfficeHour(Int $moneyChangerId) {
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID.utf8');
        $todayDate = Date('y-m-d');
        $day = date("l", strtotime($todayDate));

        $officeHour = DB::table('office_hour')
        ->join('office_hour_detail', 'office_hour.id', '=', 'office_hour_detail.officeHourId')
        ->join('money_changer', 'office_hour_detail.moneyChangerId', '=', 'money_changer.id')
        ->where('money_changer.id', $moneyChangerId)
        ->where('office_hour.day', $day)
        ->select('office_hour.openTime', 'office_hour.closeTime')
        ->first();

        if(empty($officeHour)) {
            $officeHour = 'Tutup';
            return $officeHour;
        }

        return $officeHour;
    }
}

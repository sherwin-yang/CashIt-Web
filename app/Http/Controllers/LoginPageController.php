<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\MoneyChanger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginPageController extends Controller
{
    public function navigateToLoginPage() {
        if(session()->has('user')) {
            return redirect('appointment');
        }
        return view('other-views/mc_login');
    }

    public function login(Request $request) {
        $user = '';
        $mc_or_admin = $this->checkIsAdminOrMoneyChanger($request);

        if($mc_or_admin == 'mc') {
            $user = MoneyChanger::where('email', $request->email)->first();
        }
        else if($mc_or_admin == 'admin') {
            $user = Admin::where('email', $request->email)->first();
        }

        if(!$user || !Hash::check($request->password, $user->password)) {
            return view('other-views.mc_login');
        }

        $request->session()->put('user', $user);

        if($mc_or_admin == 'mc') {
            $officeHour = $this->getOfficeHour($user->id);
            $request->session()->put('openTime', $officeHour->openTime);
            $request->session()->put('closeTime', $officeHour->closeTime);
            $request->session()->put('role', 'mc');
            return redirect()->route('appointment');
        }
        else if($mc_or_admin == 'admin') {
            $request->session()->put('role', 'admin');
            return redirect()->route('admin');
        }
    }

    private function checkIsAdminOrMoneyChanger(Request $request) {
        if(MoneyChanger::where('email', $request->email)->first()) {
            return 'mc';
        }
        else if(Admin::where('email', $request->email)->first()) {
            return 'admin';
        }
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

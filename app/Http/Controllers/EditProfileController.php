<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditProfileController extends Controller
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

    public function updateMoneyChangerInfo(Request $request) {
        if($request->button == 'ubah') {

        }
        return redirect()->route('revision');
    }
}

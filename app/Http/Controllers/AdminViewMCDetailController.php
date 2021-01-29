<?php

namespace App\Http\Controllers;

use App\Models\MoneyChanger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminViewMCDetailController extends Controller
{
    public function showMoneyChangerDetails(Request $request) {
        $moneyChanger = MoneyChanger::find($request->moneyChangerId);
        $officeHours = $this->getOfficeHour($request->moneyChangerId);

        return view('admin-view.admin_mcDetail', ['moneyChanger'=>$moneyChanger], ['officeHours'=>$officeHours]);
    }

    private function getOfficeHour(Int $moneyChangerId) {
        $officeHours = DB::table('office_hour')
        ->join('office_hour_detail', 'office_hour.id', '=', 'office_hour_detail.officeHourId')
        ->join('money_changer', 'office_hour_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('office_hour.*')
        ->where('money_changer.id', $moneyChangerId)
        ->get();

        return $officeHours;
    }
}

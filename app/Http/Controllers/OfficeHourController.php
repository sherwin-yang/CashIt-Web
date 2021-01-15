<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyChanger;
use App\Models\OfficeHour;
use Carbon\Carbon;

class OfficeHourController extends Controller
{
    function getMCOfficeHour()
    {
        $session = session()->get('user_id');
        $MoneyChanger = MoneyChanger::find($session);

        $session = session()->get('user_id');
        $index = MoneyChanger::find($session)->officeHourDetail;
        $officeHourList = array();

        foreach($index as $val){
        $officeHour = OfficeHour::find($val->officeHourId);
        $officeHourList[] = $officeHour;
        }
        $object = Carbon::now()->format('l');
        $officeHourDay = OfficeHour::where('day',$object)->first();

        return view('main-view.layout.mc_main',['officeHourList'=>$officeHourDay,'MoneyChanger'=> $MoneyChanger]);
    }
}

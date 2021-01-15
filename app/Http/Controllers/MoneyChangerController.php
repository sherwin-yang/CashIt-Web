<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyChanger;

class MoneyChangerController extends Controller
{
  
    function getMCData()
    {
        $session = session()->get('user_id');
        $MoneyChanger = MoneyChanger::find($session);
        return view('main-view.layout.mc_main', ['MoneyChanger' => $MoneyChanger]);
    }

    function getMCCurrency()
    {
        $session = session()->get('user_id');
        return MoneyChanger::find($session)->currencyDetail;
    }

}

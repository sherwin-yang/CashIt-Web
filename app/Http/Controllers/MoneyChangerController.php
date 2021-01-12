<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyChanger;

class MoneyChangerController extends Controller
{
    //
    function list($id)
    {
        return money_changer::find($id);
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyChanger;

class MoneyChangerController extends Controller
{
    function list()
    {
        $session = session()->get('user_id');
        return $session;
    }
}

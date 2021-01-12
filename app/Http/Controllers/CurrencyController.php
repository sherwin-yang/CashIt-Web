<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    function add(Request $req)
    {
        $currency= new currency;
        $currency->name=$req->name;
        $currency->buyPrice=$req->buyPrice;
        $currency->sellPrice=$req->sellPrice;
        $result=$currency->save();

        if ($result)
        {
            return["Result"=> "Data has been saved"];
        }
        else{
            return["Result"=> "Operation Failed"];
        }
        
    }

    function get(){
        return currency::all();
    }
}

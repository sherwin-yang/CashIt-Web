<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function addNewCurrency(Request $request) {
        $newCurrency = new Currency();
        $newCurrency->name = $request->name;
        $newCurrency->buyPrice = $request->buyPrice;
        $newCurrency->sellPrice = $request->sellPrice;
        $result = $newCurrency->save();

        if($result) {
            return ["Result" => "Data has been saved"];
        }
        else {
            return ["Result" => "Failed saving new data"];
        }
    }

    // public function editCurrency(Request $request) {}

}

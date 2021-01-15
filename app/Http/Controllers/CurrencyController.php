<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\CurrencyDetail;
use App\Http\Controllers\Services\GetCurrencyDetailService;

class CurrencyController extends Controller
{
    public function addNewCurrency(Request $request) {
        if($request->button == 'tambahkan') {
            $listOfCurrencyDetail = $this->getCurrencyDetailsByMoneyChangerId();
            // if $listOfCurrencyDetail not NULL, then check if there is same Currency already existing.
            if(!empty($listOfCurrencyDetail)) {
                foreach($listOfCurrencyDetail as $data) {
                    $currency = $this->getCurrencyByCurrencyDetailId($data->currencyId);
                    if($request->name == $currency->currencyName) {
                        echo '<script language="javascript"> alert("Error! Valuta tidak dapat didaftarkan karena sudah tersedia. Silahkan melakukan perubahan pada valuta yang sudah terdaftar jika belum sesuai.") </script>';
                        return view('main-view.mc_currency');
                    }
                }
            }
            // If $listOfCurrencyDetail empty and there is no same existing Currency, then add data to DB.
            $this->saveCurrencyData($request);
            return view('main-view.mc_currency');
        }
    }

    private function saveCurrencyData(Request $request) {
        $newCurrency = new Currency();
        $newCurrency->currencyName = $request->name;
        $newCurrency->buyPrice = $request->buyPrice;
        $newCurrency->sellPrice = $request->sellPrice;
        $newCurrency->save();
        $this->saveCurrencyDetailData($newCurrency->id);
    }

    private function saveCurrencyDetailData(Int $currencyId) {
        $newCurrencyDetail = new CurrencyDetail();
        $newCurrencyDetail->moneyChangerId = session()->get('user_id');
        $newCurrencyDetail->currencyId = $currencyId;
        $newCurrencyDetail->save();
    }

    private function getCurrencyDetailsByMoneyChangerId() {
        $moneyChangerId = session()->get('user_id');
        $arrayOfCurrencyDetail = CurrencyDetail::where('moneyChangerId', $moneyChangerId)->get();

        return $arrayOfCurrencyDetail;
    }

    private function getCurrencyByCurrencyDetailId(Int $currencyId) {
        $currency = Currency::find($currencyId);
        return $currency;
    }

}

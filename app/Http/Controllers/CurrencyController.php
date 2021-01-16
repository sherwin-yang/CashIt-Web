<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\CurrencyDetail;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function showCurrencies()
    {
        if(!session()->has('user.id')) {
            return redirect('login');
        }

        $currencies = $this->getListOfCurrencyByMoneyChangerId();

        return view('main-view.mc_currency', ['currencies'=>$currencies]);
    }

    public function test() {
        return redirect()->route('currency');
    }

    public function getListOfCurrencyByMoneyChangerId() {
        $moneyChangerId = session()->get('user.id');

        $currencies = DB::table('currency')
        ->join('currency_detail', 'currency_detail.currencyId', '=', 'currency.id')
        ->join('money_changer', 'currency_detail.moneyChangerId', '=', 'money_changer.id')
        ->select('currency.*')
        ->where('money_changer.id', $moneyChangerId)
        ->get();

        return $currencies;
    }

    public function addNewCurrency(Request $request) {
        if($request->button == 'tambahkan') {
            $listOfCurrencyDetail = $this->getCurrencyDetailsByMoneyChangerId();
            // if $listOfCurrencyDetail not NULL, then check if there is same Currency already existing.
            if(!empty($listOfCurrencyDetail)) {
                foreach($listOfCurrencyDetail as $data) {
                    $currency = $this->getCurrencyByCurrencyDetailId($data->currencyId);
                    if($request->name == $currency->currencyName) {
                        echo '<script language="javascript"> alert("Error! Valuta tidak dapat didaftarkan karena sudah tersedia. Silahkan melakukan perubahan pada valuta yang sudah terdaftar jika belum sesuai.") </script>';
                        return redirect()->route('currency');
                    }
                }
            }
            // If $listOfCurrencyDetail empty and there is no same existing Currency, then add data to DB.
            $this->saveCurrencyData($request);
            return redirect()->route('currency');
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
        $newCurrencyDetail->moneyChangerId = session()->get('user.id');
        $newCurrencyDetail->currencyId = $currencyId;
        $newCurrencyDetail->save();
    }

    private function getCurrencyDetailsByMoneyChangerId() {
        $moneyChangerId = session()->get('user.id');
        $arrayOfCurrencyDetail = CurrencyDetail::where('moneyChangerId', $moneyChangerId)->get();

        return $arrayOfCurrencyDetail;
    }

    private function getCurrencyByCurrencyDetailId(Int $currencyId) {
        $currency = Currency::find($currencyId);
        return $currency;
    }

    public function handleUbahButton(Request $request) {
        if($request->button == 'ubah') {
            $this->updateCurrency($request);
        }
        else if($request->button == 'hapus') {
            $this->deleteCurrency($request);
        }

        return redirect()->route('currency');
    }

    private function updateCurrency(Request $request) {
        $currency = Currency::find($request->currencyId);
        $currency->currencyName = $request->name;
        $currency->buyPrice = $request->buyPrice;
        $currency->sellPrice = $request->sellPrice;
        $currency->save();
    }

    private function deleteCurrency(Request $request) {
        $currency = Currency::find($request->currencyId);
        $currency->delete();
    }
}

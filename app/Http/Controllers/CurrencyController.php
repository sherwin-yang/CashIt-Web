<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\MoneyChanger;
use App\Models\CurrencyDetail;
class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = session()->get('user_id');
        $index = MoneyChanger::find($session)->currencyDetail;
        $currencyIndex = array();

        foreach($index as $val){
        $currency = Currency::find($val->currencyId);
        $currencyIndex[] = $currency;
        }
        // return $currency;
        return view('main-view.mc_currency',['currencyIndex' => $currencyIndex]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currency');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCurrency = new Currency();
        $newCurrency->name = $request->name;
        $newCurrency->buyPrice = $request->buyPrice;
        $newCurrency->sellPrice = $request->sellPrice;
        $result = $newCurrency->save();

        if($result) {
            return redirect('/currency')->with('success', 'Currency saved!');
        }
        else {
            return ["Result" => "Failed saving new data"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::find($id);
        return $currency;
        // return redirect('back',['currencyId' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $idUpdate = $req->get("modalId");
        $currency = Currency::find($idUpdate);
        $currency->name = $req->get('name');
        $currency->buyPrice = $req->get('buyPrice');
        $currency->sellPrice = $req->get('sellPrice');
        $currency->save();
            return redirect()->back();
            // return $currency;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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

}

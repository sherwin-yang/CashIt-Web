<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\MoneyChangerController;
use App\Http\Controllers\OfficeHourController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(session()->has('user_id')) {
        return redirect('appointment');
    }
    return view('other-views/mc_welcome');
});

/*
---------- Authentication ----------
*/
Route::get('/login', function () {
    if(session()->has('user_id')) {
        return redirect('currency');
    }
    return view('other-views/mc_login');
})->name('login');
Route::post('/login', [AuthController::class, 'webUserLogin'])->name('login');

Route::get('/register', function () {
    if(session()->has('user_id')) {
        return redirect('appointment');
    }
    return view('other-views/mc_register');
});

Route::post('/register', [AuthController::class, 'signUpNewMoneyChanger'])->name('register');

Route::get('/logout', [AuthController::class, 'logOut']);


---------- Currency View ----------
*/
Route::resource('/currency', CurrencyController::class);
Route::post('/currencyUpdate','CurrencyController@update');
Route::get('/currency', function () {
    if(!session()->has('user_id')) {
        return redirect('login');
    }
    return view('main-view/mc_currency');
})->name('currency');
Route::post('/currency', [CurrencyController::class, 'addNewCurrency'])->name('addNewCurrency');

/*
---------- Appointment View ----------
*/
Route::get('/appointment', [AppointmentController::class, 'getListOfAppointmentByMoneyChangerId'])->name('appointment');

/*
---------- Edit Profiel View ----------
*/
Route::get('/editProfile', function () {
    if(!session()->has('user_id')) {
        return redirect('login');
    }
    return view('other-views/mc_edit_profile');
});

Route::get("/getMCCurrency",[MoneyChangerController::class,'getMCCurrency']);
Route::get("/Header",[OfficeHourController::class,'getMCOfficeHour'])->name('header');
Route::get("/OfficeHourList",[OfficeHourController::class,'getMCOfficeHour'])->name('header');
Route::put("/updateCurrency",[CurrencyController::class,'updateCurrency']);

<?php

use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\AppointmentPageController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* ---------- Auth ---------- */
Route::post('/customerLogin', [ApiServicesController::class, 'customerLogin']);
Route::post('/customerRegister', [ApiServicesController::class, 'registerCustomer']);

/* ---------- Main 1/2 ---------- */
Route::get('/getMoneyChangerByTo_ExchangReceive', [ApiServicesController::class, 'getMoneyChangerByTo_ExchangReceive']);
Route::get('/getAllMoneyChanger', [ApiServicesController::class, 'getAllMoneyChanger']);

Route::get('/getCurrencyByMoneyChangerId', [ApiServicesController::class, 'getCurrencyByMoneyChangerId']);
Route::get('/getOfficeHourByMoneyChangerId', [ApiServicesController::class, 'getOfficeHourByMoneyChangerId']);
Route::get('/getAllReviewsByMoneyChangerId', [ApiServicesController::class, 'getAllReviewsByMoneyChangerId']);
Route::post('/makeNewAppointment', [ApiServicesController::class, 'makeNewAppointment']);

/* ---------- Main 3 ---------- */
Route::get('/getAppointmentsByUserId', [ApiServicesController::class, 'getAppointmentsByUserId']);
Route::get('/getMoneyChangerFilteredByAppointment', [ApiServicesController::class, 'getMoneyChangerFilteredByAppointment']);
Route::get('/getAppointmentDetailFilteredByAppointment', [ApiServicesController::class, 'getAppointmentDetailFilteredByAppointment']);

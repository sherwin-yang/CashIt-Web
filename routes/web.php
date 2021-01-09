<?php

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
    return view('other-views/mc_welcome');
});

Route::get('/appointment', function () {
    return view('main-view/mc_appointment');
});

Route::get('/currency', function () {
    return view('main-view/mc_currency');
});

Route::get('/login', function () {
    return view('other-views/mc_login');
});

Route::get('/register', function () {
    return view('other-views/mc_register');
});

Route::get('/editProfile', function () {
    return view('other-views/mc_edit_profile');
});

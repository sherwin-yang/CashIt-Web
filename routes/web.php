<?php

use App\Http\Controllers\WelcomePageController;
use App\Http\Controllers\RegisterPageController;
use App\Http\Controllers\LoginPageController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\RevisionPageController;
use App\Http\Controllers\AppointmentPageController;
use App\Http\Controllers\CurrencyPageController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\EditProfilePageController;
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

/*
---------- Money Changer ----------
*/

Route::get('/', [WelcomePageController::class, 'navigateToWelcomePage']);

// Authentication
Route::get('/login', [LoginPageController::class, 'navigateToLoginPage']);
Route::post('/login', [LoginPageController::class, 'login'])->name('login');

Route::get('/register', [RegisterPageController::class, 'navigateToRegisterPage']);
Route::post('/register', [RegisterPageController::class, 'signUpNewMoneyChanger'])->name('register');

Route::get('/logout', [LogOutController::class, 'logout']);

// Revision Page
Route::get('/revision', [RevisionPageController::class, 'getRevisionNote'])->name('revision');
Route::get('/editProfile', [RevisionPageController::class, 'navigateToEditProfile']);
Route::get('/editProfile', [EditProfilePageController::class, 'showMoneyChangerInfo'])->name('showEditProfilePage');
Route::post('/updateMC', [EditProfilePageController::class, 'updateMoneyChangerInfo'])->name('editProfile');

// Currency Page
Route::get('/currency', [CurrencyPageController::class, 'showCurrencies'])->name('currency');
Route::post('/currency', [CurrencyPageController::class, 'addNewCurrency'])->name('addNewCurrency');
Route::post('/editCurrency', [CurrencyPageController::class, 'handleUbahButton'])->name('editCurrency');

// Appointment Page
Route::get('/appointment', [AppointmentPageController::class, 'showAppointments'])->name('appointment');
Route::post('/appointment', [AppointmentPageController::class, 'finishAppointment'])->name('finishAppointment');

/*
---------- Admin ----------
*/
Route::get('/admin', [AdminPageController::class, 'getAllPendingMoneyChanger'])->name('admin');
Route::post('/approveMC', [AdminPageController::class, 'approveMoneyChanger'])->name('approveMoneyChanger');
Route::post('/giveRevision', [AdminPageController::class, 'giveRevisionNote'])->name('giveRevision');

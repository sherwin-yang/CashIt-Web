<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomePageController extends Controller
{
    public function navigateToWelcomePage() {
        if(session()->has('user.id')) {
            return redirect('appointment');
        }
        return view('other-views.welcome');
    }
}

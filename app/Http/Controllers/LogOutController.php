<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogOutController extends Controller
{
    public function logout() {
        if(session()->has('user')) {
            session()->pull('user');
        }
        return redirect()->route('login');
    }
}

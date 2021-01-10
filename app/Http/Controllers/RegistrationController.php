<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    //

    public function index() {
        if(DB::connection()->getDatabaseName()) {
            echo "conncted sucessfully to database "
            .DB::connection()->getDatabaseName();
        }
    }
}

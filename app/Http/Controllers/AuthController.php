<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MoneyChanger;
use App\Models\OfficeHour;
use App\Models\OfficeHourDetail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Auth for Customer
    |--------------------------------------------------------------------------
    */

    public function customerLogin(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Credential does not match or user has not been registered']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user
        ];

        return response($response);
    }

    public function registerNewCustomer(Request $request) {
        $newUser = new User();
        $newUser->userName = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        $response = [
            'user' => $newUser
        ];

        return response($response);
    }

}

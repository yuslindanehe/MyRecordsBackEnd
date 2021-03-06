<?php


namespace App\Http\Controllers\Api;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::debug($request);
        if (Auth::attempt($credentials)) {
            return response("ok",200);
        }

        return response("The username or password was not correct", 500);
    }
}

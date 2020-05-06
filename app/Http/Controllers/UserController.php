<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Staff;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function emailVerification(Request $request) {
        $user = User::where('email', $request->email)->first();
        if($user) {
            if($user->role == User::PATIENT) {
                $person = Patient::where('emailAddress', $user->email)->first();
            } else {
                $person = Staff::where('emailAddress', $user->email)->first();
            }

            if (Hash::check($person->lastName.$person->emailAddress, $request->code)) {
                $user->email_verified_at = new Carbon();
                $user->save();

                return response()->json("Thank you, your email is verified", 200);
            } else
                return response()->json("Your email is not match", 200);
        } else {
            return response()->json("", 200);
        }
    }

    public function forgotPasswordVerification(Request $request)
    {
        $user = User::where('email', $request->emailAddress)->first();
        if($user) {
            if($user->role == User::PATIENT) {
                $person = Patient::where('zipCode', $request->zipCode)
                    ->where('dob', $request->dateOfBirth)
                    ->where('emailAddress', $request->emailAddress)
                    ->first();
            } else {
                $person = Staff::where('zipCode', $request->zipCode)
                    ->where('dob', $request->dateOfBirth)
                    ->where('emailAddress', $request->emailAddress)
                    ->first();
            }

            if ($person) {
                return response()->json("ok", 200);
            }
        } else {
            return response()->json("user not found", 401);
        }
    }

    public function send2FACode(Request $request) {
        $user = User::where('email', $request->get('emailAddress'))->first();
        $code = rand ( 11111 , 99999 );

        if ($request->get('method') == 'phone')
            $user->send2FACode($code);
        else {

        }

        $user->two_fa_token = $code;
        $user->save();
    }

    public function authenticate2FACode(Request $request) {
        $user = User::where('email', $request->get('emailAddress'))->first();
        if ($user->two_fa_token == $request->get('code')) {
            return response()->json('ok',200);
        } else {
            return response()->json('incorrect code', 401);
        }
    }

    public function resetPassword(Request $request) {
        $user = User::where('email', $request->get('emailAddress'))->first();
        $user->password = Hash::make($request->get('newPassword'));
        $user->save();

        return response()->json('ok',200);
    }
}

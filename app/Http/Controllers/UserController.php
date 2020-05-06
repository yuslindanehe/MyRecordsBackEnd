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
}

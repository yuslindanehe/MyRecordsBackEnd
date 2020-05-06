<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->send2FACode();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        if ($user->role == User::PATIENT)
            $person = Patient::select('firstName', 'lastName')->where('emailAddress', $user->email)->first();
        else
            $person = Staff::select('firstName', 'lastName')->where('emailAddress', $user->email)->first();
        $user->name = $person->firstName . ' ' . $person->lastName;

        return response()->json(['user' => auth()->user()]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function authenticate2FACode(Request $request) {
        $user = auth()->user();
        $user->fresh();
        if ($user->two_fa_token == $request->get('code')) {
            return response()->json('ok',200);
        } else {
            return response()->json('incorrect code', 401);
        }
    }

    public function send2FACode() {
        $user = auth()->user();
        $code = rand ( 11111 , 99999 );
        $user->send2FACode($code);

        $user->two_fa_token = $code;
        $user->save();
    }
}

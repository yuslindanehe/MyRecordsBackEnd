<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Nexmo\Laravel\Facade\Nexmo;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const PATIENT = 'patient';
    const DOCTOR = 'doctor';
    const NURSE = 'nurse';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function send2FACode($code)
    {
        if($this->role == self::PATIENT) {
            $patient = Patient::select('phoneNumber')->where('emailAddress', $this->email)->first();

            Nexmo::message()->send([
                'to'=> $patient->phoneNumber,
                'from' => config('nexmo.phone_number'),
                'text' => $code
            ]);
        }
    }
}

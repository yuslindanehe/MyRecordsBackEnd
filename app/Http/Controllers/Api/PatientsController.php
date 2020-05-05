<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Patient::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Patient::create($request->only([
            'ssn',
            'emailAddress',
            'firstName',
            'lastName',
            'dob',
            'address',
            'address2',
            'city',
            'state',
            'zipCode',
            'phoneNumber'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Patient::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->update($request->only([
            'ssn',
            'emailAddress',
            'firstName',
            'lastName',
            'dob',
            'address',
            'address2',
            'city',
            'state',
            'zipCode',
            'phoneNumber'
        ]));

        return $patient;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Patient::findOrFail($id)->delete();
    }

    public function register(Request $request) {
        Patient::create([
            'emailAddress' => $request->get('emailAddress'),
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'dob' => $request->get('dob'),
            'address' => $request->get('address'),
            'address2' => $request->get('address2'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zipCode' => $request->get('zipCode'),
            'phoneNumber' => $request->get('phoneNumber'),
        ]);

        return User::create([
            'email' => $request->get('emailAddress'),
            'password' => Hash::make($request->get('password')),
            'role' => User::PATIENT
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Staff::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Staff::create($request->only([
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
            'phoneNumber',
            'position'
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
        return Staff::findOrFail($id);
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
        $staff = Staff::findOrFail($id);
        $staff->update($request->only([
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
            'phoneNumber',
            'position'
        ]));
        return $staff;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Staff::findOrFail($id)->delete();
    }
}

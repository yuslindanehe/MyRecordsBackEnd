<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Medication::create($request->only([
            'name',
            'qty',
            'reffilable',
            'instruction',
            'prescriptionId'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $prescriptionId
     * @return \Illuminate\Http\Response
     */
    public function show($prescriptionId)
    {
        return Medication::where('prescriptionId', $prescriptionId)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $prescriptionId)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $prescriptionId
     * @return \Illuminate\Http\Response
     */
    public function destroy($prescriptionId)
    {
        return Medication::where('prescriptionId', $prescriptionId)->delete();
    }
}

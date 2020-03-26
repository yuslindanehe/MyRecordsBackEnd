<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Visit::create($request->only([
            'patientId',
            'doctorId',
            'nurseId',
            'visitDate',
            'weight',
            'bloodPressure',
            'diagnose',
            'prescriptionId'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function show($patientId)
    {
        return Visit::where('patientId', $patientId)->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $patientId)
    {
        $visit = Visit::where('patientId', $patientId)->firstOrFail();
        $visit->update($request->only([
            'patientId',
            'doctorId',
            'nurseId',
            'visitDate',
            'weight',
            'bloodPressure',
            'diagnose',
            'prescriptionId'
        ]));

        return $visit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function destroy($patientId)
    {
        return Visit::where('patientId', $patientId)->firstOrFail()->delete();
    }
}

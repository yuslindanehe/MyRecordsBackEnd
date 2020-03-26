<?php

namespace App\Http\Controllers\Api;

use App\HealthInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthInformationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return HealthInformation::create($request->only([
            'patientId',
            'height',
            'allergies',
            'immunizationHistory',
            'illnessHistory'
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
        return HealthInformation::where('patientId', $patientId)->firstOrFail();
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
        $healthInformation =  HealthInformation::where('patientId', $patientId)->firstOrFail();
        $healthInformation->update($request->only([
            'patientId',
            'height',
            'allergies',
            'immunizationHistory',
            'illnessHistory'
        ]));

        return $healthInformation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function destroy($patientId)
    {
        return HealthInformation::where('patientId', $patientId)->firstOrFail()->delete();
    }
}

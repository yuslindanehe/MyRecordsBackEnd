<?php

namespace App\Http\Controllers\Api;

use App\Patient;
use Illuminate\Support\Facades\Auth;
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
        return HealthInformation::updateOrCreate(['patientId' => $request->get('patientId')], [
            'height' => $request->get('height'),
            'weight' => $request->get('weight'),
            'allergies' => $request->get('allergies'),
            'immunizationHistory' => $request->get('immunizationHistory'),
            'illnessHistory' => $request->get('illnessHistory')
        ]);
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
            'weight',
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

    public function showBasedOnPatient()
    {
        $patient = Patient::where('emailAddress', Auth::user()->email)->first();
        $healthInformation = HealthInformation::where('patientId', $patient->id)->first();
        $data[] = [
            'patient_height' => $healthInformation->height,
            'patient_weight' => $healthInformation->weight,
            'detail_allergies' => $healthInformation->allergies,
            'immunization_history' => $healthInformation->immunizationHistory,
            'illnessHistory' => $healthInformation->illnessHistory
        ];

        return $data;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Medication;
use App\Patient;
use App\Prescription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Staff;

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
        $prescription = Prescription::create($request->only([
            'date',
            'prescribedBy',
            'patient_id'
        ]));

        return Medication::create(
            ['name' => $request->get('name'),
            'qty' => $request->get('qty'),
            'refillable' => $request->get('refillable'),
            'instruction' => $request->get('instruction'),
            'prescriptionId' => $prescription->id
        ]);
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

    public function showBasedOnPatient()
    {
        $patient = Patient::where('emailAddress', Auth::user()->email)->first();
        $prescriptions = Prescription::where('patient_id', $patient->id)->get();
        $data = [];
        foreach($prescriptions as $prescription) {
            $medications = $prescription->medication;
            foreach($medications as $medication) {
                $data[] = [
                    'prescription_date' => $prescription->date,
                    'medication_name' => $medication->name,
                    'refill_or_not' => $medication->refillable?'Yes':'No',
                    'medication_quantity' => $medication->qty,
                    'instruction' => $medication->instruction,
                    'prescribe_by' => Staff::find($prescription->prescribedBy)->firstName . " " . Staff::find($prescription->prescribedBy)->lastName
                ];
            }
        }

        return $data;
    }
}

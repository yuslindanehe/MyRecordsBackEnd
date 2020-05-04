<?php

namespace App\Http\Controllers\Api;

use App\TestResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Support\Facades\Auth;
use App\Staff;

class TestResultController extends Controller
{
    public function showBasedOnPatient()
    {
        $patient = Patient::where('emailAddress', Auth::user()->email)->first();
        $testResults = TestResult::where('patientId', $patient->id)->get();
        $data = [];
        foreach($testResults as $testResult) {
            $data[] = [
                'test_date' => $testResult->testDate,
                'test_name' => $testResult->testName,
                'detail_test_result' => $testResult->testResult,
                'ordered_by' => Staff::find($testResult->orderedBy)->firstName . " " . Staff::find($testResult->orderedBy)->lastName
            ];
        }

        return $data;
    }

    public function store(Request $request)
    {
        return TestResult::create($request->only([
            'patientId',
            'testDate',
            'testName',
            'testResult',
            'orderedBy'
        ]));
    }
}

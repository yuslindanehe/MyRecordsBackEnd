<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $table = 'test_results';

    protected $fillable = ['patientId', 'testDate', 'testName', 'testResult', 'orderedBy'];
}

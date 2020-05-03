<?php

namespace App;

use App\Medication;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescription';

    public function medication() {
        return $this->hasMany('App\Medication', 'prescriptionId', 'id');
    }
}

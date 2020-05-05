<?php

namespace App;

use App\Medication;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescription';
    protected $fillable = ['date', 'prescribedBy', 'patient_id'];

    public function medication() {
        return $this->hasMany('App\Medication', 'prescriptionId', 'id');
    }

    public function staff() {
        return $this->belongsTo('App\Staff','prescribedBy', 'id');
    }
}

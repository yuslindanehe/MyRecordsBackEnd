<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medication';

    public function prescription()
    {
        return $this->belongsTo('App\Prescription', 'id', 'prescriptionId');
    }
}

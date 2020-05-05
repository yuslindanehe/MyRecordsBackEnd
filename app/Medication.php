<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medication';
    protected $fillable = ['name', 'qty', 'refillable', 'instruction', 'prescriptionId'];

    public function prescription()
    {
        return $this->belongsTo('App\Prescription', 'id', 'prescriptionId');
    }
}

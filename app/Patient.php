<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    protected $fillable = ['emailAddress', 'firstName', 'lastName', 'dob', 'address', 'address2', 'city', 'state',
        'zipCode', 'phoneNumber'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_number',
        'first_name',
        'last_name',
        'date_of_birth',
        'sex',
        'phone',
        'address',
    ];
}

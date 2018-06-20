<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    public function patient()
    {
        $this->belongsTo('App\User', 'patient_id');
    }

    public function appointment()
    {
        $this->belongsTo('App\Appointment');
    }
}

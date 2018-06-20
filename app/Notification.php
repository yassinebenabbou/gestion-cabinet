<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function doctor()
    {
        return $this->belongsTo('App\Doctor', 'doctor_id');
    }

    public function receptionist()
    {
        return $this->belongsTo('App\Receptionist', 'receptionist_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }
}

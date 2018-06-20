<?php

namespace App;

class Patient extends User
{
    protected $table = 'users';

    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'patient_id')->orderBy('created_at', 'DESC');
    }

    public function consultations()
    {
        return $this->hasManyThrough('App\Consultation', 'App\Appointment', 'patient_id', 'appointment_id');
    }

}
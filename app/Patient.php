<?php

namespace App;

class Patient extends User
{
    protected $table = 'users';
    private $CIN;
    private $phone;
    private $appointments;

    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'patient_id')->orderBy('created_at', 'DESC');
    }

}
<?php

namespace App;

class Doctor extends User
{
    protected $table = 'users';

    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'doctor_id')
            ->where('doctor_id', $this->id)
            ->whereNotNull('confirmation_date')
            ->orderBy('created_at', 'DESC');
    }

}
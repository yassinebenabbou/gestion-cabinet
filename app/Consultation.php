<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    private $id;
    private $comment;
    private $appointment;

    public function appointment()
    {
        $this->belongsTo('App\Appointment');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    private $id
    private $appointment;
    private $subject;
    private $date;
    private $content;

    public function appointment()
    {
        return $this->belongsTo('App\Appointment');
    }

}

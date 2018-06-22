<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function appointment()
    {
        return $this->belongsTo('App\Appointment');
    }

}

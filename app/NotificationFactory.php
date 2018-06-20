<?php

namespace App;

class NotificationFactory
{
    public static function getNotification(Appointment $a, $type)
    {
        $n = new Notification();
        $n->content = "Cher {$a->patient->name},<br />Vous avez un rendez vous le {$a->appointment_date->format('j F Y à H\\hi')}";
        $n->content .= ", avec Dr. {$a->doctor->name}<br />";
        $n->doctor_id = $a->doctor_id;
        $n->patient_id = $a->patient_id;
        $n->receptionist_id = $a->receptionist_id;
        $n->subject = $type . ' de votre rendez vous';
        $n->save();
        return $n;
    }

}
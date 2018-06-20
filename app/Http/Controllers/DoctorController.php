<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Appointment;

class DoctorController extends Controller
{
    public function home() {
        //$appointments = Appointment::whereNotNull('confirmation_date')->where('doctor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $appointments = Auth::user()->userable->appointments;
        return view('appointment.index', compact('appointments'));
    }
}

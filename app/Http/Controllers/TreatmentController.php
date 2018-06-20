<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function attachTreatment(Appointment $appointment, Request $request) {
        $appointment->treatments()->attach($request->input('treatment'));
    }
}

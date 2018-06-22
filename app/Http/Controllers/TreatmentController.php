<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function attach(Appointment $appointment, Request $request)
    {
        $appointment->treatments()->attach($request->input('treatment'), ['comment' => $request->input('comment')]);
        return redirect()->route('appointment.show', [$appointment->id, '#nav-treatments']);
    }

    public function detach(Appointment $appointment, $treatment)
    {
        $appointment->treatments()->detach($treatment);
        return redirect()->route('appointment.show', [$appointment->id, '#nav-treatments']);
    }
}

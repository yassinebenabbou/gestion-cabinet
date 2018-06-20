<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Consultation;
use Illuminate\Http\Request;
use Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Auth::user()->userable->consultations;
        return view('consultations.index', compact('consultations'));
    }

    public function show(Consultation $consultation)
    {
        return view('consultation.show', compact('consultation'));
    }

    public function create(Appointment $appointment)
    {
        return view('consultation.create', compact('appointment'));
    }

    public function store($appointment, Request $request)
    {
        $c = new Consultation();
        $c->appointment_id = $appointment;
        $c->comment = $request->input('comment');
        $c->save();
        return redirect()->route('appointment.show', [$appointment]);
    }
}

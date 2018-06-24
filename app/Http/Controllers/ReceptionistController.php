<?php

namespace App\Http\Controllers;

use App\Events\AppointmentConfirmed;
use App\Events\AppointmentReminded;
use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use Auth;

class ReceptionistController extends Controller
{
    public function index()
    {
        $doctors = User::where('role_id', 1)->get();
        $patients = User::where('role_id', 3)->get();
        return view('receptionist.home', compact('doctors', 'patients'));
    }


    public function search()
    {
        $patients = User::where('role_id', 3)->get();
        $doctors = User::where('role_id', 1)->get();
        $receptionists = User::where('role_id', 2)->get();
        return view('appointment.search', compact('patients', 'doctors', 'receptionists'));
    }

    public function addAppointment(Request $request)
    {
        $a = new Appointment();
        $a->appointment_date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day').' '.$request->input('hour');
        $a->patient_id = $request->input('patient');
        $a->doctor_id = $request->input('doctor');
        $a->receptionist_id = Auth::user()->id;
        $a->reason = $request->input('reason');
        $a->confirmation_date = date('Y-m-d H:i:s');
        $a->save();
        return redirect()->route('appointment.show', ['appointment' => $a->id]);
    }

    public function addPatient(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $u = new User();
        $u->email = $request->input('email');
        $u->name = $request->input('name');
        $u->phone = $request->input('phone');
        $u->CIN = $request->input('CIN');
        $u->password = bcrypt($request->input('password'));
        $u->type = 'App\Patient';
        $u->role_id = 3;
        $u->save();
        $message = 'Patient ajouté avec succés.';
        return view('done', compact('message'));
    }

}

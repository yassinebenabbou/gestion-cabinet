<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Patient;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::where('role_id', 3)->get();
        return view('patient.index', compact('patients'));
    }

    public function home()
    {
        $doctors = User::where('role_id', 1)->get();
        return view('patient.home', compact('doctors'));
    }

    public function store(Request $request)
    {
        $patient = new User();
        $patient->name = $request->input('name');
        $patient->email = $request->input('email');
        $patient->password = bcrypt($request->input('password'));
        $patient->role_id = 3;
        $patient->save();

        return redirect('/home');
    }

    public function show(User $user)
    {
        return view('patient.show', compact('user'));
    }

    public function history($id)
    {
        $patient = Patient::with('appointments.consultation')->with('appointments.treatments')->find($id);


        return view('patient.history', compact('patient'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('patient.show', compact('user'));
    }


    public function update(User $user, Request $request)
    {
        $auth = Auth::user();
        if(!($auth->hasRoleReceptionist() || $auth->hasRoleDoctor()) && ($auth->id != $user->id)) {
            return response('Unauthorized.', 401);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $newPassword = $request->input('password');
        if(!empty($newPassword)) {
            $user->password = bcrypt($newPassword);
        }
        $user->save();

        if($auth->hasRoleReceptionist() || $auth->hasRoleDoctor()){
            return redirect()->route('patient.show', [$user->id]);
        }
        return redirect()->route('patient.profile');
    }


    public function appointments()
    {
        $appointments = Auth::user()->userable->appointments;
        return view('appointment.index', compact('appointments'));
    }

}



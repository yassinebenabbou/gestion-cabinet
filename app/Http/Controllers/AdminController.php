<?php

namespace App\Http\Controllers;

use App\Receptionist;
use Illuminate\Http\Request;
use App\Doctor;
use App\User;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function addDoctor(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $u = new User();
        $u->email = $request->input('email');
        $u->name = $request->input('name');
        $u->specialty = $request->input('specialty');
        $u->password = bcrypt($request->input('password'));
        $u->type = 'App\Doctor';
        $u->role_id = 1;
        $u->save();
        $message = 'Médecin ajouté avec succés.';
        return view('done', compact('message'));
    }

    public function addReceptionist(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $u = new User();
        $u->email = $request->input('email');
        $u->name = $request->input('name');
        $u->password = bcrypt($request->input('password'));
        $u->type = 'App\Receptionist';
        $u->role_id = 2;
        $u->save();
        $message = 'Secretaire ajoutée avec succés.';
        return view('done', compact('message'));
    }

    public function updateDoctor(Doctor $doctor, Request $request)
    {
        $doctor->email = $request->input('email');
        $doctor->name = $request->input('name');
        $doctor->specialty = $request->input('specialty');
        if($request->input('password')) {
            $doctor->password = bcrypt($request->input('password'));
        }
        $doctor->type = 'App\Doctor';
        $doctor->role_id = 1;
        $doctor->save();
        return redirect()->route('admin.list');
    }

    public function updateReceptionist(Receptionist $receptionist, Request $request)
    {
        $receptionist->email = $request->input('email');
        $receptionist->name = $request->input('name');
        if($request->input('password')) {
            $receptionist->password = bcrypt($request->input('password'));
        }
        $receptionist->type = 'App\Receptionist';
        $receptionist->role_id = 2;
        $receptionist->save();
        return redirect()->route('admin.list');
    }

    public function editReceptionist(Receptionist $receptionist)
    {
        return view('admin.edit-receptionist', compact('receptionist'));
    }

    public function editDoctor(Doctor $doctor)
    {
        return view('admin.edit-doctor', compact('doctor'));
    }

    public function list()
    {
        $doctors = User::where('role_id', 1)->get();
        $receptionists = User::where('role_id', 2)->get();
        return view('admin.list', compact('doctors', 'receptionists'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}

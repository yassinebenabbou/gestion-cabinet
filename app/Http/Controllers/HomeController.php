<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch(Auth::user()->role->name) {
            case Role::Patient:
                return redirect('/patient'); break;
            case Role::Receptionist:
                return redirect('/receptionist'); break;
            case Role::Doctor:
                return redirect('/doctor'); break;
        }
        return redirect('/');
    }
}

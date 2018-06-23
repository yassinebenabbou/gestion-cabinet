<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Treatment;
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

    public function index()
    {
        $treatments = Treatment::all();
        return view('treatment.index', compact('treatments'));
    }

    public function edit(Treatment $treatment)
    {
        return view('treatment.edit', compact('treatment'));
    }

    public function store(Request $request)
    {
        $treatment = new Treatment();
        $treatment->type = $request->input('type');
        $treatment->description = $request->input('description');
        $treatment->price = $request->input('price');
        $treatment->save();
        return redirect()->route('treatment.index');
    }

    public function update(Treatment $treatment, Request $request)
    {
        $treatment->type = $request->input('type');
        $treatment->description = $request->input('description');
        $treatment->price = $request->input('price');
        $treatment->save();
        return redirect()->route('treatment.index');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatment.index');
    }
}

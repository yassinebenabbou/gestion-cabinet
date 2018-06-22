<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Consultation;
use App\Events\NotificationEvent;
use App\NotificationFactory;
use App\Treatment;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user()->userable;
        $appointments = $user->appointments;
        return view('appointment.index', compact('appointments'));
    }

    public function store(Request $request)
    {
        $a = new Appointment();
        $a->appointment_date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day').' '.$request->input('hour');
        $a->patient_id = Auth::user()->id;
        $a->reason = $request->input('reason');
        $a->doctor_id = $request->input('doctor');
        $a->save();
        return redirect()->route('appointment.show', ['appointment' => $a->id]);
    }

    public function show(Appointment $appointment)
    {
        $treatments = Treatment::all();
        return view('appointment.show', compact('appointment', 'treatments'));
    }

    public function confirmed()
    {
        $appointments = Appointment::whereNotNull('confirmation_date')->orderBy('created_at', 'DESC')->get();
        return view('appointment.index', compact('appointments'));
    }

    public function unconfirmed()
    {
        $appointments = Appointment::whereNull('confirmation_date')->orderBy('created_at', 'DESC')->get();
        return view('appointment.index', compact('appointments'));
    }

    public function edit(Appointment $appointment)
    {
        return view('appointment.edit', compact('appointment'));
    }

    public function update(Appointment $appointment, Request $request)
    {
        $newDate = $request->input('year').'-'.$request->input('month').'-'.$request->input('day').' '.$request->input('hour');
        if($appointment->appointment_date == $newDate) {
            $message = 'Pas de changement effectué.';
            return view('done', compact('message'));
        };
        $appointment->appointment_date = $newDate;
        $appointment->confirmation_date = null;
        $appointment->reason = $request->input('reason');
        $appointment->save();
        $message = "Rendez vous changé. Vous recevrez un email une fois confirmé.";
        return view('done', compact('message'));
    }


    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        $message = "Le rendez vous a été supprimé.";
        return view("done", compact('message'));
    }

    public function search(Request $request)
    {
        //DB::enableQueryLog();
        $fromDate = $request->input('from-year').'-'.$request->input('from-month').'-'.$request->input('from-day');
        $toDate = $request->input('to-year').'-'.$request->input('to-month').'-'.$request->input('to-day');
        $appointments = Appointment::whereBetween(DB::raw('DATE(appointment_date)'), [$fromDate, $toDate]);
        $filters = ['doctor', 'patient'];
        foreach($filters as $f) {
            if(!empty($request->input($f))) {
                $appointments = $appointments->where($f.'_id', $request->input($f));
            }
        }

        $appointments = $appointments->orderBy('created_at', 'DESC')->get();
        //dd(DB::getQueryLog());
        return view('appointment.index', compact('appointments'));
    }

    public function remind(Appointment $appointment)
    {
        $n = NotificationFactory::getNotification($appointment, 'Rappel');
        event(new NotificationEvent($n));
        $message = 'Un email de rappel a été envoyé.';
        $appointment->reminder_date = date("Y-m-d H:i:s");
        $appointment->save();
        return view('done', compact('message'));
    }

    public function confirm(Appointment $appointment, Request $request)
    {
        $appointment->appointment_date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day').' '.$request->input('hour');
        $appointment->confirmation_date = date("Y-m-d H:i:s");
        $appointment->receptionist_id = Auth::user()->id;
        $appointment->save();
        $message = "Rendez vous confirmé. Un email a été envoyé au patient.";
        $n = NotificationFactory::getNotification($appointment, 'Confirmation');
        event(new NotificationEvent($n));
        return view('done', compact('message'));
    }

    public function freeHours($date, $doctor)
    {
        //dd(Appointment::whereDate('appointment_date', $date)->whereNotNull('confirmation_date')->get(['appointment_date'])->toArray());
        $freeHours = [];
        for($i = 9; $i <= 17; $i ++) {
            $freeHours[] =  sprintf('%02d', $i) . ":00";
            $freeHours[] =  sprintf('%02d', $i) . ":30";
        }

        $takenHours = array_map(function($a) {
            return date('H:i', strtotime($a['appointment_date']));
        }, Appointment::where('doctor_id', $doctor)->whereDate('appointment_date', $date)->whereNotNull('confirmation_date')->get(['appointment_date'])->toArray());

        $result = [];
        foreach(array_diff($freeHours, $takenHours) as $h) {
            $oh = new \stdClass();
            $oh->hour = $h;
            $result[] = $oh;
        }
        return response()->json($result, 200);
    }

    public function calendar()
    {
        $doctors = Doctor::where('role_id', 1)->get();
        $tmp = Appointment::whereNotNull('confirmation_date')->orderBy('appointment_date')->get();
        $appointments = [];
        foreach($tmp as $a) {
            $t = new \stdClass();
            $t->title = $a->patient->name . '  avec Dr. ' . $a->doctor->name . ($a->reason ? ' (motif: ' . $a->reason . ')' : '');
            $t->start = $a->appointment_date->format('Y-m-d\\TH:i:s');
            $t->doctorId = $a->doctor->id;
            $appointments[] = $t;
        }


        $appointments = json_encode($appointments);

        return view('appointment.calendar', compact('appointments', 'doctors'));
    }


}

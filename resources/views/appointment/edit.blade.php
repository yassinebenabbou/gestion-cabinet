@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">RendezVous</div>

                <div class="card-body col-md-8">
                    @role('patient')
                    <form action="{{ route('appointment.update', [$appointment->id]) }}" role="form" class="form-horizontal" method="POST">
                    @else
                    <form action="{{ route('appointment.confirm', [$appointment->id]) }}" role="form" class="form-horizontal" method="POST">
                    @endrole
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="patient">Patient: (<a href="{{ route('patient.show', [$appointment->patient->id]) }}">Accéder au profile</a>)</label>
                            <input type="patient" class="form-control" id="patient" disabled value="{{ $appointment->patient->name }}">
                        </div>
                        <div class="form-group">
                            <label for="patient">Medecin:</label>
                            <input type="patient" class="form-control" id="patient" disabled value="{{ $appointment->doctor->name }}">
                        </div>
                        <div class="form-group">
                            <label for="patient">Date du rendez-vous:</label>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="day">Jour</label>
                                <select name="day" class="form-control" id="day">
                                    @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ sprintf('%02d', $i) }}" {{ $i == $appointment->appointment_date->format('d') ? 'selected' : '' }}>{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="month">Mois</label>
                                <select name="month" class="form-control" id="month">
                                    <?php $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; ?>
                                    @foreach($months as $i => $m)
                                    <option value="{{ sprintf('%02d', $i+1) }}" {{ ($i+1) == $appointment->appointment_date->format('m') ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="year">Année</label>
                                <select name="year" class="form-control" id="year">
                                    @for($i = 2018; $i <= 2019; $i++)
                                    <option value="{{ $i }}" {{ ($i+1) == $appointment->appointment_date->format('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="hour">Heure</label>
                                <select name="hour" class="form-control" id="hour">
                                    @for($i = 9; $i <= 16; $i++)
                                    <option value="{{ $i }}:00:00" {{ $i.':00' == $appointment->appointment_date->format('H:i') ? 'selected' : '' }}>{{ $i }}h00</option>
                                    <option value="{{ $i }}:30:00" {{ $i.':30' == $appointment->appointment_date->format('H:i') ? 'selected' : '' }}>{{ $i }}h30</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason">Motif:</label>
                            <input name="reason" class="form-control" id="reason" value="{{ $appointment->reason }}"/>
                        </div>
                        @role('patient')
                        <div class="form-group">
                            <label for="state">Etat:</label>
                            <input type="state" class="form-control" id="state" disabled value="{{ $appointment->isConfirmed() ? 'Confirmé' : 'Non confirmé' }}">
                        </div>
                        @endrole

                        @if(!($appointment->isConfirmed()))
                        @role('receptionist')
                        <button type="submit" class="btn btn-primary">Confirmer Rendez Vous</button>
                        @else
                        <button type="submit" class="btn btn-primary">Modifier rendez vous</button>
                        @endrole
                        @else
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        @endif
                    </form>

                    <a href="{{ route('appointment.destroy', [$appointment->id]) }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('destroy-form').submit();">
                        <button class="btn btn-danger" style="margin-top: 10px">Supprimer</button>
                    </a>
                    <form id="destroy-form" action="{{ route('appointment.destroy', [$appointment->id]) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

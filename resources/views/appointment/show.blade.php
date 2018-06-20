@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Consultation</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Soins</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="card">
                        <div class="card-header">RendezVous</div>

                        <div class="card-body col-md-8">
                            <form action="#" role="form" class="form-horizontal" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="patient">Patient:</label>
                                    <input type="text" class="form-control" id="patient" disabled value="{{ $appointment->patient->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="doctor">Patient:</label>
                                    <input type="text" class="form-control" id="doctor" disabled value="{{ $appointment->doctor->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="patient">Date du rendez vous:</label>
                                    <input type="text" class="form-control" id="patient" disabled value="{{ $appointment->appointment_date->format('j F Y à H\\hi') }}">
                                </div>
                                <div class="form-group">
                                    <label for="patient">Date de demande:</label>
                                    <input type="text" class="form-control" id="patient" disabled value="{{ $appointment->created_at->format('j F Y à H\\hi') }}">
                                </div>
                                <div class="form-group">
                                    <label for="patient">Date de confirmation:</label>
                                    <input type="text" class="form-control" id="patient" disabled value="{{ $appointment->isConfirmed() ? $appointment->confirmation_date->format('j F Y à H\\hi').' par '.$appointment->receptionist->name : 'Non confirmé' }}">
                                </div>
                                <div class="form-group">
                                    <label for="patient">Date de rappel:</label>
                                    <input type="text" class="form-control" id="patient" disabled value="{{ $appointment->isReminded() ? $appointment->reminder_date->format('j F Y à H\\hi') : '--' }}">
                                </div>
                            </form>

                        </div>
                    </div>

                    @if($appointment->consultation)
                    <div class="card">
                        <div class="card-header">Consultation</div>

                        <div class="card-body col-md-8">
                            <p>
                                {{ $appointment->consultation->comment }}
                            </p>

                        </div>
                    </div>
                    @endif

                    @if(sizeof($appointment->treatments))
                    <div class="card">
                        <div class="card-header">Soins</div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Soin</th>
                                    <th>Prix</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointment->treatments as $t)
                                <tr>
                                    <td>{{ $t->type }}</td>
                                    <td>{{ $t->price }}</td>
                                    <td>
                                        @role('doctor')
                                        <a href="{{ route('appointment.detachTreatment', [$appointment->id, $t->id]) }}"><button class="btn btn-primary btn-sm">Supprimer</button></a>
                                        @endrole
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>

        </div>
    </div>
</div>
@endsection

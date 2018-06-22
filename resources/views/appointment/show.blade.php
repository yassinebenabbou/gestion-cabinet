@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-home" aria-selected="false">Details</a>
                    <a class="nav-item nav-link" id="nav-consultation-tab" data-toggle="tab" href="#nav-consultation" role="tab" aria-controls="nav-profile" aria-selected="false">Consultation</a>
                    <a class="nav-item nav-link" id="nav-treatments-tab" data-toggle="tab" href="#nav-treatments" role="tab" aria-controls="nav-contact" aria-selected="false">Soins</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">

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
                                    <label for="doctor">Medecin:</label>
                                    <input type="text" class="form-control" id="doctor" disabled value="{{ $appointment->doctor->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="reason">Motif:</label>
                                    <input name="reason" class="form-control" id="reason" disabled value="{{ $appointment->reason ?? '--' }}" />
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


                </div>
                <div class="tab-pane fade" id="nav-consultation" role="tabpanel" aria-labelledby="nav-consultation-tab">
                    <div class="card">
                        <div class="card-header">Details de consultation</div>

                        <div class="card-body col-md-8">
                            <p>
                                {{ $appointment->consultation ? $appointment->consultation->comment : 'Aucune consultation trouvée.'}}
                            </p>

                        </div>
                    </div>
                    @role('doctor')
                    @if($appointment->consultation)
                    <div class="card" style="margin-top: 10px">
                        <div class="card-header">Modifier consultation</div>

                        <div class="card-body col-md-8">
                            <form action="{{ route('consultation.update', [$appointment->consultation->id]) }}" role="form" class="form-horizontal" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="comment">Commentaire:</label>
                                    <textarea id="comment" name="comment" class="form-control" required>{{ $appointment->consultation->comment }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>

                        </div>
                    </div>
                    @else
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-header">Ajouter consultation</div>

                        <div class="card-body col-md-8">
                            <form action="{{ route('consultation.store', [$appointment->id]) }}" role="form" class="form-horizontal" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">Commentaire:</label>
                                    <textarea id="comment" name="comment" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>

                        </div>
                    </div>
                    @endif
                    @endrole
                </div>
                <div class="tab-pane fade" id="nav-treatments" role="tabpanel" aria-labelledby="nav-treatments-tab">
                    @if(sizeof($appointment->treatments))
                    <div class="card">
                        <div class="card-header">Soins</div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Soin</th>
                                    <th>Prix</th>
                                    <th>Commentaire</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointment->treatments as $t)
                                <tr>
                                    <td>{{ $t->type }}</td>
                                    <td>{{ $t->price }}</td>
                                    <td>{{ $t->pivot->comment }}</td>
                                    <td>
                                        @role('doctor')
                                        <a href="{{ route('appointment.treatment.detach', [$appointment->id, $t->id]) }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('destroy-form-{{ $t->id }}').submit();">
                                            <button class="btn btn-primary btn-sm">Supprimer</button>
                                        </a>
                                        <form id="destroy-form-{{ $t->id }}" action="{{ route('appointment.treatment.detach', [$appointment->id, $t->id]) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-header">Soins</div>

                        <div class="card-body">
                            Aucun soin trouvé.
                        </div>
                    </div>
                    @endif

                    @role('doctor')
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-header">Ajouter soin</div>

                        <div class="card-body col-md-8">
                            <form action="{{ route('appointment.treatment.attach', [$appointment->id]) }}" role="form" class="form-horizontal" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="treatment">Soin:</label>
                                    <select id="treatment" name="treatment" class="form-control" required>
                                        @foreach($treatments as $t)
                                        <option value="{{ $t->id }}">{{ $t->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Commentaire (factultatif):</label>
                                    <textarea id="comment" name="comment" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>

                        </div>
                    </div>
                    @endrole
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

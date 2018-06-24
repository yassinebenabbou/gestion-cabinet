@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Rendez vous</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Date / Heure</th>
                                <th>Médecin</th>
                                <th>Motif</th>
                                <th>Confirmé</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $a)
                            <tr>
                                <td>{{ $a->patient->name }}</td>
                                <td>{{ $a->appointment_date->format('j F Y à H\\hi') }}</td>
                                <td>{{ $a->doctor->name }}</td>
                                <td>{{ $a->reason }}</td>
                                <td>{{ $a->isConfirmed() ? 'Oui' : 'Non' }}</td>
                                <td>
                                    <a href="{{ route('appointment.edit', [$a->id]) }}"><button class="btn btn-info btn-sm">
                                            @if($a->isConfirmed())
                                            Modifier
                                            @else
                                            @role('patient')
                                            Modifier
                                            @else
                                            Confirmer
                                            @endrole
                                            @endif
                                        </button></a>
                                    <a href="{{ route('appointment.destroy', [$a->id]) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('destroy-form-{{ $a->id }}').submit();">
                                        <button class="btn btn-danger btn-sm">Supprimer</button>
                                    </a>
                                    <a href="{{ route('appointment.show', [$a->id]) }}"><button class="btn btn-primary btn-sm">Details</button></a>
                                    <form id="destroy-form-{{ $a->id }}" action="{{ route('appointment.destroy', [$a->id]) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @role('receptionist')
                                    @if($a->isConfirmed())
                                    <a href="{{ route('appointment.remind', [$a->id]) }}"><button class="btn btn-primary btn-sm">Rappel</button></a>
                                    @endif
                                    @endrole
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

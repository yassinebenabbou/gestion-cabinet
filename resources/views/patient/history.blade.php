@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Historique</div>

                <div class="card-body">
                    <h3>{{ $patient->name }}</h3>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Commentaire</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patient->appointments as $a)
                        <tr class="table-primary">
                            <td>Rendez Vous</td>
                            <td>Le {{ $a->appointment_date->format('j F Y à H\\hi') }}</td>
                        </tr>
                        @if($a->consultation)
                        <tr>
                            <td>Consultation</td>
                            <td>{{ $a->consultation->comment }}</td>
                        </tr>
                        @endif
                        @foreach($a->treatments as $t)
                        <tr>
                            <td>{{ $t->type }}</td>
                            <td>{{ $t->comment }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-dark">
                            <td colspan="2"></td>
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
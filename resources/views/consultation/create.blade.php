@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Consultation</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('consultation.store', [$appointment->id]) }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="patient">Patient:</label>
                            <input type="patient" class="form-control" id="patient" disabled value="{{ $appointment->patient->name }}">
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="text" class="form-control" id="date" disabled value="{{ $appointment->appointment_date->format('j F Y à H\\hi') }}">
                        </div>
                        <div class="form-group">
                            <label for="comment">Commentaire:</label>
                            <textarea class="form-control" id="comment" name="comment"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter consultation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

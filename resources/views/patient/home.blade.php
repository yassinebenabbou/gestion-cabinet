@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Prendre un rendez vous</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('appointment.store') }}" role="form" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="patient">Patient:</label>
                            <input type="patient" class="form-control" id="patient" disabled value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="doctor">Medecin:</label>
                            <select name="doctor" class="form-control" id="doctor" required>
                                @foreach($doctors as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="day">Jour</label>
                                <select name="day" class="form-control" id="day">
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $i == date('j') ? 'selected' : '' }}>{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="month">Mois</label>
                                <select name="month" class="form-control" id="month">
                                    <?php $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; ?>
                                    @foreach($months as $i => $m)
                                    <option value="{{ sprintf('%02d', $i+1) }}" {{ ($i+1) == date('n') ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="year">Année</label>
                                <select name="year" class="form-control" id="year">
                                    @for($i = 2018; $i <= 2019; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="hour">Heure</label>
                                <select name="hour" class="form-control" id="hour">
                                    @for($i = 9; $i <= 16; $i++)
                                    <option value="{{ $i }}:00:00">{{ $i }}h00</option>
                                    <option value="{{ $i }}:30:00">{{ $i }}h30</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Prenez Rendez Vous</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ajouter un patient</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('receptionist.patient') }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <div >
                                <strong style="color: red">Email invalide</strong>
                            </div>


                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Telephone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label for="CIN">CIN:</label>
                            <input type="text" class="form-control" id="CIN" name="CIN" value="{{ old('CIN') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter Patient</button>
                    </form>

                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header">Prendre un rendez vous</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('receptionist.appointment') }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="patient">Patient:</label>
                            <select name="patient" class="form-control" id="patient" required>
                                @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
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
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason">Motif (facultatif):</label>
                            <input name="reason" class="form-control" id="reason" />
                        </div>
                        <button type="submit" class="btn btn-primary">Prendre Rendez Vous</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

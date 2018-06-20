@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Recherche avancée</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('appointment.search') }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="patient">Patient: </label>
                            <select id="patient" class="form-control" name="patient">
                                <option value=""></option>
                                @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="doctor">Medecin:</label>
                            <select id="doctor" class="form-control" name="doctor">
                                <option value=""></option>
                                @foreach($doctors as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="from-day">A partir du:</label>
                                <select name="from-day" class="form-control" id="from-day">
                                    @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ sprintf('%02d', $i) }}" {{ $i == date('j') ? 'selected' : '' }}>{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="from-month">&nbsp;</label>
                                <select name="from-month" class="form-control" id="from-month">
                                    <?php $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; ?>
                                    @foreach($months as $i => $m)
                                    <option value="{{ sprintf('%02d', $i+1) }}" {{ ($i+1) == date('n') ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="from-year">&nbsp;</label>
                                <select name="from-year" class="form-control" id="from-year">
                                    @for($i = 2018; $i <= 2019; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="to-day">Jusqu'au:</label>
                                <select name="to-day" class="form-control" id="to-day">
                                    @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ sprintf('%02d', $i) }}" {{ $i == date('j') ? 'selected' : '' }}>{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="to-month">&nbsp;</label>
                                <select name="to-month" class="form-control" id="to-month">
                                    <?php $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; ?>
                                    @foreach($months as $i => $m)
                                    <option value="{{ sprintf('%02d', $i+1) }}" {{ ($i+1) == date('n') ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="to-year">&nbsp;</label>
                                <select name="to-year" class="form-control" id="to-year">
                                    @for($i = 2018; $i <= 2019; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Chercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

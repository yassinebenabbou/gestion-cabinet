@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ajouter un patient</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('patient.update', [$user->id]) }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Telephone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="CIN">CIN:</label>
                            <input type="text" class="form-control" id="CIN" name="CIN" value="{{ $user->CIN }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
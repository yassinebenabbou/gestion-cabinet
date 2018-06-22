@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ajouter un médecin</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('admin.doctor') }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="specialty">Spécialité:</label>
                            <input type="text" class="form-control" id="specialty" name="specialty" value="{{ old('specialty') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <div >
                                <strong style="color: red">Email déjầ utilisé</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter Médecin</button>
                    </form>

                </div>
            </div>
            <hr />

            <div class="card">
                <div class="card-header">Ajouter une secrétaire</div>

                <div class="card-body col-md-8">
                    <form action="{{ route('admin.receptionist') }}" role="form" class="form-horizontal" method="POST">
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
                                <strong style="color: red">Email déjầ utilisé</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter Secrétaire</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

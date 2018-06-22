@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Médecins</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Spécialité</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doctors as $d)
                        <tr>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->specialty }}</td>
                            <td>{{ $d->email }}</td>
                            <td>
                                <a href="#"
                                   onclick="event.preventDefault();
                                                     document.getElementById('destroy-form-{{ $d->id }}').submit();">
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </a>
                                <form id="destroy-form-{{ $d->id }}" action="{{ route('admin.destroy', [$d->id]) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header">Secrétaires</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receptionists as $r)
                        <tr>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->email }}</td>
                            <td>
                                <a href="#"
                                   onclick="event.preventDefault();
                                                     document.getElementById('destroy-form-{{ $r->id }}').submit();">
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </a>
                                <form id="destroy-form-{{ $r->id }}" action="{{ route('admin.destroy', [$r->id]) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
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

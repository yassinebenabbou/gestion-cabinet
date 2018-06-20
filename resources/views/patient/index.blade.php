@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Patients</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->phone }}</td>
                            <td>{{ $p->email }}</td>
                            <td>
                                <a href="{{ route('patient.show', [$p->id]) }}"><button class="btn btn-info btn-sm">Editer</button></a>
                                <a href="#" style="display: none"
                                   onclick="event.preventDefault();
                                                     document.getElementById('destroy-form').submit();">
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </a>
                                <form id="destroy-form" action="#" method="POST" style="display: none;">
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

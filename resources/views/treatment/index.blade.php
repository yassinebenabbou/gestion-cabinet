@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Soins</div>

                <div class="card-body">
                    <form action="{{ route('treatment.store') }}" role="form" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input name="type" class="form-control" id="type" required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input name="description" class="form-control" id="description" required/>
                        </div>
                        <div class="form-group">
                            <label for="price">Coût:</label>
                            <input name="price" class="form-control" id="price" required/>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter soin</button>
                    </form>
                </div>
            </div>
            <div class="card" style="margin-top: 10px">
                <div class="card-header">Soins</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($treatments as $t)
                        <tr>
                            <td>{{ $t->type }}</td>
                            <td>{{ $t->description }}</td>
                            <td>{{ $t->price}}</td>
                            <td>
                                <a href="{{ route('treatment.edit', [$t->id]) }}"><button class="btn btn-info btn-sm">Modifier</button></a>
                                <a href="#"
                                   onclick="event.preventDefault();
                                                     document.getElementById('destroy-form-{{ $t->id }}').submit();">
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </a>
                                <form id="destroy-form-{{ $t->id }}" action="{{ route('treatment.destroy', [$t->id]) }}" method="POST" style="display: none;">
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

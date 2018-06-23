@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Soin</div>

                <div class="card-body">
                    <form action="{{ route('treatment.update', [$treatment->id]) }}" role="form" class="form-horizontal" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input name="type" class="form-control" id="type" value="{{ $treatment->type }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input name="description" class="form-control" id="description" value="{{ $treatment->description }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="price">Coût:</label>
                            <input name="price" class="form-control" id="price" value="{{ $treatment->price }}" required/>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier soin</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

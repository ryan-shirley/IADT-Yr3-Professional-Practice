@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <p class="h2">New Tag</p>
            <form method="POST" action="{{ route('tags.store' )}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old( 'name') }}">
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter description" value="{{ old( 'description') }}">
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                </div>
                <button class="btn btn-primary" type="submit" value="Store">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

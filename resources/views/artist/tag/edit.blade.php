@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')


<div class="col-md-9">
  <div class="card">
      <div class="card-body">
        <p class="h5"><a href="{{ route('tags.index') }}" class="text-secondary">All Tags</a> / Edit {{ $tag->name }}</p>
        <p class="h2">Edit Tag details</p>
        <form method="POST" action="{{ route('tags.update', $tag->id )}}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">New Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter new name" value="{{ old( 'name', $tag->name) }}">
                <div class="text-danger">{{ $errors->first('name') }}</div>
            </div>

            <div class="form-group">
                <label for="description">New Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter new description" value="{{ old( 'description', $tag->description) }}">
                <div class="text-danger">{{ $errors->first('description') }}</div>
            </div>

            <button class="btn btn-primary" type="submit" value="Store">Submit</button>
        </form>

      </div>
  </div>
</div>


</div>
</div>
@endsection

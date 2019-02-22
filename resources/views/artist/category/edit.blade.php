@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @include('layouts.artistmenu')
    <div class="col-md-9">
      <div class="card">
          <div class="card-body">
              <p class="h5"><a href="{{ route('categories.index') }}" class="text-secondary">All Categories</a> / Edit {{ $category->name }}</p>
              <p class="h2">Edit Category details</p>
              <form method="POST" action="{{ route('categories.update', $category->id )}}">
                  @method('PATCH')
                  @csrf
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter new name" value="{{ old( 'name', $category->name) }}">
                      <div class="text-danger">{{ $errors->first('name') }}</div>
                  </div>
                  <!-- /.Name -->

                  <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" class="form-control" name="description" placeholder="Enter new description" value="{{ old( 'description', $category->description) }}">
                      <div class="text-danger">{{ $errors->first('description') }}</div>
                  </div>
                  <!-- /.Description -->

                  <button class="btn btn-primary" type="submit" value="Store">Submit</button>
              </form>
              <!-- /.Form -->
          </div>
          <!-- /.Card-body -->
      </div>
      <!-- /.Card -->
    </div>
    <!-- /.Col -->
  </div>
  <!-- /.Row -->
</div>
<!-- /.Conatiner -->
@endsection

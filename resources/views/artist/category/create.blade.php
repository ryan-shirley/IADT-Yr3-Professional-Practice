@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.artistmenu')
        <div class="col-md-9">
          <div class="card">

              <div class="card-body">
                  <p class="h2">New Category</p>
                  <form method="POST" action="{{ route('categories.store' )}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old( 'name') }}">
                          <div class="text-danger">{{ $errors->first('name') }}</div>
                      </div>
                      <!-- /.Name -->

                      <div class="form-group">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" name="description" placeholder="Enter description" value="{{ old( 'description') }}">
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
<!-- /.Container -->
@endsection

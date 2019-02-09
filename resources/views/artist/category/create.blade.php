@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.artistmenu')
        <div class="col-md-9">
          <div class="card">
              <div class="card-header">Categories</div>
              <div class="card-body">

                  <form method="POST" action="{{ route('categories.store' )}}" enctype="multipart/form-data">
                      @csrf
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td>Name</td>
                                  <td><input class="form-control" type="text" name="name" value="{{ old('name') }}"/></td>
                                  <td>{{ $errors->first('name') }}</td>
                              </tr>
                              <tr>
                                  <td>Description</td>
                                  <td><input class="form-control" type="text" name="description"  value="{{ old('description') }}"/></td>
                                  <td>{{ $errors->first('description') }}</td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <button class="form-control btn btn-primary" type="submit" value="Store">Submit</button>
                                </td>
                              </tr>
                          </tbody>
                      </table>
                  </form>

              </div>
          </div>
        </div>
    </div>
</div>
@endsection

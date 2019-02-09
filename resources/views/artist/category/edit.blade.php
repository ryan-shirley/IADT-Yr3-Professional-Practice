@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
  <div class="card">
      <div class="card-header">Edit Category</div>

      <form method="POST" action="{{ route('categories.update', $category->id )}}">
          @method('PATCH')
          @csrf
          <table class="table">
              <tbody>
                  <tr>
                      <td>Name</td>
                      <td><input class="form-control" type="text" name="name" value="{{ old( 'name', $category->name) }}"/></td>
                      <td>{{ $errors->first('name') }}</td>
                  </tr>
                  <tr>
                      <td>Description</td>
                      <td><input class="form-control" type="text" name="description"  value="{{ old( 'description', $category->description) }}"/></td>
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

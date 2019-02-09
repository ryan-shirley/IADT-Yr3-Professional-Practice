@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
  <div class="card">
      <div class="card-header">Edit Tag details</div>

      <form method="POST" action="{{ route('tags.update', $tag->id )}}">
          @method('PATCH')
          @csrf
          <table class="table">
              <tbody>
                  <tr>
                      <td>Name</td>
                      <td><input class="form-control" type="text" name="name" value="{{ old( 'name', $tag->name) }}"/></td>
                      <td>{{ $errors->first('name') }}</td>
                  </tr>
                  <tr>
                      <td>Description</td>
                      <td><input class="form-control" type="text" name="description"  value="{{ old( 'description', $tag->description) }}"/></td>
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

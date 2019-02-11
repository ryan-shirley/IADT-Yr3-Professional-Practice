@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
  <div class="card">
      <div class="card-body">
          <p class="h2">All Tags</p>
          <a class="btn btn-outline-dark btn-sm mb-2" href="{{ route('tags.create') }}" role="button">Create Tag</a>

          <table class="table">
              <thead class="thead-light">
              <tr>
                  <td scope='col'><h4>Name</h4></td>
                  <td scope='col'><h4>description</h4></td>
                  <td scope='col'><h4>Action</h4></td>
              </tr>
              </thead>
              <tbody>
                  @foreach ($tags as $tag)
                  <tr>
                      <td scope="row">{{ $tag->name }}</td>
                      <td>{{ $tag->description }}</td>
                      <td>
                          <form action="{{ action('Artist\TagController@destroy', $tag->id )}}" method="post">
                              @csrf
                              <a class="btn btn-outline-dark btn-sm" href="{{ route('tags.edit', $tag->id) }}" role="button">Edit</a>
                              <a class="btn btn-outline-dark btn-sm" href="{{ route('tags.viewProducts', $tag->id) }}" role="button">View Products</a>
                              <input name="_method" type="hidden" value="DELETE">
                              <button class="btn btn-outline-dark btn-sm" >Delete</button>
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

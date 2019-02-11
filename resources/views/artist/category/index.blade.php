@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
  <div class="card">
      <div class="card-body">
          <p class="h2">All Categories</p>
          <a class="btn btn-outline-dark btn-sm mb-2" href="{{ route('categories.create') }}" role="button">Create Category</a>

          <table class="table">
              <thead class="thead-light">
              <tr>
                  <td scope='col'><h4>Name</h4></td>
                  <td scope='col'><h4>description</h4></td>
                  <td scope='col'><h4>Action</h4></td>
              </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $cat)
                  <tr>
                      <td scope="row">{{ $cat->name }}</td>
                      <td>{{ $cat->description }}</td>
                      <td>
                          <form action="{{ action('Artist\CategoryController@destroy', $cat->id )}}" method="post">
                              @csrf
                              <a class="btn btn-outline-dark btn-sm" href="{{ route('categories.edit', $cat->id) }}" role="button">Edit</a>
                              <a class="btn btn-outline-dark btn-sm" href="{{ route('categories.viewProducts', $cat->id) }}" role="button">View Products</a>
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

@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @include('layouts.artistmenu')
    <div class="col-md-9">
      <div class="card">
          <div class="card-header">Categories</div>
          <div class="card-body">
              <a class="btn btn-primary btn-sm" href="{{ route('categories.create') }}" role="button">Create Category</a>

              <table class="table">
                  <thead class="thead-light">
                  <tr>
                      <td scope='col'>Name</td>
                      <td scope='col'>description</td>
                      <td scope='col'>Action</td>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($categories as $cat)
                      <tr>
                          <td scope="row">{{ $cat->name }}</td>
                          <td>{{ $cat->description }}</td>
                          <td>
                              <a class="" href="{{ route('categories.edit', $cat->id) }}" role="button">Edit</a><br/>
                              <a class="" href="{{ route('categories.viewProducts', $cat->id) }}" role="button">View Products</a>
                              <form action="{{ action('Artist\CategoryController@destroy', $cat->id )}}" method="post">
                                  @csrf
                                  <input name="_method" type="hidden" value="DELETE">
                                  <button class="btn btn-danger btn-sm" >Delete</button>
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

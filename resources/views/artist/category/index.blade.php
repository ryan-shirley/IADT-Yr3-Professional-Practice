@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">Artist Home</div>
        <div class="card-body">
          <ul>
            <li><a href="{{ route('artist.home') }}">Home</a></li>
            <li>Orders</li>
            <ul>
              <li><a href="{{ route('artist.orders.index') }}">All Orders</a></li>
              <li>Active Orders</li>
              <li>Completed Orders</li>
            </ul>
            <li>Products</li>
            <ul>
              <li><a href="{{ route('products.index') }}">All Products</a></li>
              <li><a href="{{ route('categories.index') }}">Categories</a></li>
              <li><a href="{{ route('tags.index') }}">Tags</a></li>
            </ul>
            <li>Account Settings</li>
            <li>Logout</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
          <div class="card-header">Categories</div>
          <div class="card-body">
              <a class="btn btn-primary" href="{{ route('categories.create') }}" role="button">Create Category</a>

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
                              <a class="btn btn-primary" href="{{ route('categories.edit', $cat->id) }}" role="button">Edit</a>
                              <a class="btn btn-secondary" href="{{ route('categories.viewProducts', $cat->id) }}" role="button">View Products</a>
                              <form action="{{ action('Artist\CategoryController@destroy', $cat->id )}}" method="post">
                                  @csrf
                                  <input name="_method" type="hidden" value="DELETE">
                                  <button class="btn btn-danger btn-small" >Delete</button>
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

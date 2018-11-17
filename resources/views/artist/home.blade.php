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
            <li>All Orders</li>
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
      <div class="card-header">Artist Home</div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif

        You are logged in!
<br />
        <a class="btn btn-primary" href="{{ route('products.index') }}" role="button">Products</a>
        <a class="btn btn-primary" href="{{ route('tags.index') }}" role="button">Tags</a>
        <a class="btn btn-primary" href="{{ route('categories.index') }}" role="button">Categories</a>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

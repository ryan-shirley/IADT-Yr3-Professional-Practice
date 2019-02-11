@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
  <div class="card">
      <div class="card-body">
        <p class="h5"><a href="{{ route('products.index') }}" class="text-secondary">All Products</a> / {{ $product->name }}</p>
        <p class="h2">{{ $product->name }} (Product)</p>


        <table class="table">
          <tbody>
            <tr scope="row">
              <td scope="col">Name</td>
              <td scope="col">{{ $product->name }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Description</td>
              <td scope="col">{{ $product->description }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Price</td>
              <td scope="col">&euro;{{ $product->price }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Sale Price</td>
              <td scope="col">&euro;{{ $product->sale_price }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Category</td>
              <td scope="col">{{ $product->categories{0} }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Tags</td>
              <td scope="col">{{ $product->tags }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Stock</td>
              <td scope="col">{{ $product->stock }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Date Created</td>
              <td scope="col">{{ $product->created_at }}</td>
            </tr>
            <tr scope="row">
              <td scope="col">Product Image</td>
              <td scope="col">
                <img class="w-25" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" alt="Card image cap">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
</div>
</div>
</div>
</div>
@endsection

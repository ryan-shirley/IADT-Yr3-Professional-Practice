@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('layouts.artistmenu')
      <div class="col-md-9">
        <div class="card">
            <div class="card-header"><a href="{{ route('products.index') }}">All Products</a> / {{ $product->name }}</div>
            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr scope="row">
                    <td scope="col">Product Image</td>
                    <td scope="col">
                      <img class="w-25" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" alt="Card image cap">
                    </td>
                  </tr>
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
                    <td scope="col">Date Created</td>
                    <td scope="col">{{ $product->created_at }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
      </div>
      </div>
    </div>
</div>
@endsection

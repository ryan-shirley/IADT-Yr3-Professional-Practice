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
              <!-- /.Name -->
              <tr scope="row">
                <td scope="col">Description</td>
                <td scope="col">{{ $product->description }}</td>
              </tr>
              <!-- /.Description -->
              <tr scope="row">
                <td scope="col">Price</td>
                <td scope="col">&euro;{{ $product->price }}</td>
              </tr>
              <!-- /.Price -->

              <!-- <tr scope="row">
                <td scope="col">Sale Price</td>
                <td scope="col">&euro;{{ $product->sale_price }}</td>
              </tr> -->

              <tr scope="row">
                <td scope="col">Category</td>
                <td scope="col">{{ $product->categories{0}->name }}</td>
              </tr>
              <!-- /.Category -->
              <tr scope="row">
                <td scope="col">Tags</td>
                <td scope="col">
                @foreach($product->tags as $tag)
                    {{ $tag->name }},
                  @endforeach
                </td>
              </tr>
              <!-- /.Tags -->
              <tr scope="row">
                <td scope="col">Stock</td>
                <td scope="col">{{ $product->stock }}</td>
              </tr>
              <!-- /.Stock -->
              <tr scope="row">
                <td scope="col">Date Created</td>
                <td scope="col">{{ $product->created_at }}</td>
              </tr>
              <!-- /.Date Created -->
              <tr scope="row">
                <td scope="col">Product Image</td>
                <td scope="col">
                  <img class="w-25" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" alt="Card image cap">
                </td>
              </tr>
              <!-- /.Product Image -->
            </tbody>
            <!-- /.tbody -->
          </table>
          <!-- /.Table -->
      </div>
      <!-- /.Card-body -->
  </div>
  <!-- /.Card -->
</div>
<!-- /.Col -->
</div>
<!-- /.Row -->
</div>
<!-- /.Container -->
@endsection

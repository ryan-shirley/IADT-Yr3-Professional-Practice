@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')
<div class="col-md-9">
    <div class="card">
      <div class="card-body">
          <p class="h2">All Products</p>
          <a class="btn btn-outline-dark btn-sm mb-2" href="{{ route('products.create') }}" role="button">Create Product</a>

          <table class="table">
              <thead class="thead-light">
              <tr>
                  <td scope='col'></td>
                  <td scope='col'><h5>Name</h5></td>
                  <!-- <td scope='col'><h5>Description</h5></td> -->
                  <td scope='col'><h5>Price</h5></td>
                  <!-- <td scope='col'><h5>Sale Price</h5></td> -->
                  <td scope='col'><h5>Category</h5></td>
                  <td scope='col'><h5>Tags</h5></td>
                  <td scope='col'><h5>Stock</h5></td>
                  <td scope='col'><h5>action</h5></td>
              </tr>
              </thead>
              <tbody>
                  @foreach ($products as $p)
                  <tr>
                      <td scope="row"><img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($p->featured_img)->url ) }}" /></td>
                      <td>{{ $p->name }}</td>
                      <!-- <td>{{ $p->description }}</td> -->
                      <td>&euro;{{ $p->price }}</td>
                      <!-- <td>&euro;{{ $p->sale_price }}</td> -->

                      <td>
                          @foreach ($p->categories as $c)
                              {{ $c->name }}
                          @endforeach
                      </td>
                      <td>
                          @foreach ($p->tags as $tag)
                              {{ $tag->name }}
                          @endforeach
                      </td>
                      <td>{{ $p->stock }}</td>
                      <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('products.show', $p->id) }}" role="button">View</a>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('products.edit', $p->id) }}" role="button">Edit</a>
                            <form action="{{ action('Artist\ProductController@destroy', $p->id )}}" method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-outline-dark btn-sm" >Delete</button>
                            </form>
                            </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
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

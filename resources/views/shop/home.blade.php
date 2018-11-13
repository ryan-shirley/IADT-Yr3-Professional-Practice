@extends('layouts.app')

@section('content')
<div class="container">

  <h2 class="text-center">Latest Products</h2>
  <div class="row">
    @foreach ($products as $p)
    <div class="col-4">
      <img class="card-img-top" src="/images/default-img.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Name: {{ $p->name }}</h5>
        <p>
          Price: {{ $p->price }} </br>
          Description: {{ $p->description }} </br>
          Categories: @foreach ($p->categories as $cat)
              {{ $cat->name }}
          @endforeach </br>
          Tags: @foreach ($p->tags as $tag)
              {{ $tag->name }}
          @endforeach </br>
          Sale Price: {{ $p->sale_price }} </br>
          Featured Img: {{ $p->featured_img }} </br>
          <a class="btn btn-outline-dark" href="{{ route('cart.add') }}?product_id={{ $p->id }}" role="button">Add To Cart</a>
        </p>
      </div>
    </div>
    @endforeach
  </div>

  <h2 class="text-center">Categories</h2>
  <div class="row">
    @foreach ($categories as $cat)
    <div class="col-4">
      <a href="{{ route('categories.viewProducts', $cat->id) }}">
        <img class="card-img-top" src="/images/default-img.jpg" alt="Card image cap">
      </a>
      <div class="card-body">
        <a href="{{ route('categories.viewProducts', $cat->id) }}">
          <h5 class="card-title">{{ $cat->name }}</h5>
        </a>
        <p>{{ $cat->description }}</p>
      </div>
    </div>
    @endforeach
  </div>

  <h2 class="text-center">Tags</h2>
  <div class="row">
    @foreach ($tags as $tag)
    <div class="col-4">
      <a href="{{ route('tags.viewProducts', $tag->id) }}">
        <img class="card-img-top" src="/images/default-img.jpg" alt="Card image cap">
      </a>
      <div class="card-body">
        <a href="{{ route('tags.viewProducts', $tag->id) }}">
          <h5 class="card-title">{{ $tag->name }}</h5>
        </a>
        <p>{{ $tag->description }}</p>
      </div>
    </div>
    @endforeach
  </div>

</div>
@endsection

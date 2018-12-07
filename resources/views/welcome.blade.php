@extends('layouts.app')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide d-none d-sm-block" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/images/carousel-img.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/images/carousel-img.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/images/carousel-img.jpg" alt="Third slide">
    </div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container">
    <h2 class="text-center my-4">Latest Categories</h2>
    <div class="row">
      @foreach ($categories as $cat)
      <div class="col-4">
        <a href="{{ route('categories.viewProducts', $cat->id) }}">
          <img class="card-img-top" src="storage/product_images/placeholder.jpg" alt="Card image cap">
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
</div>

@endsection

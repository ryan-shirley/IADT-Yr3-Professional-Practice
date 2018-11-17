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
          <h2 class="text-center">Categories</h2>
          <br/>
          <div class="card-deck">
            <div class="card">
              <img class="card-img-top" src="/images/placeholder.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title text-center">Wallscrolls</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="/images/placeholder.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title text-center">Wallscrolls</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="/images/placeholder.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title text-center">Wallscrolls</h5>
              </div>
            </div>
          </div>
        </div>

@endsection

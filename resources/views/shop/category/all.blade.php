@extends('layouts.app')

@section('content')

<section class="image-title">
    <div class="content-wrapper">
        <div class="inner">
            <h1>{{ $category->name }}</h1>
        </div>
    </div>
</section>
<!--/.Image Title -->

<div class="container">
    <ul class="nav justify-content-center shop-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('shop.home') }}">All Product</a>
        </li>
        @foreach ($categories as $cat)
        <li class="nav-item">
            <a class="nav-link {{ $category->id == $cat->id ? ' active ' : null }}" href="{{ route('shop.category.all', $cat->id) }}">{{ $cat->name }}</a>
        </li>
        @endforeach
    </ul>
    <!--/.Row -->

    <section class="product-list">
        <div class="row">
            @foreach ($category->products as $p)
                <div class="col-3 product">
                    <a href="{{ route('shop.product', $p->id) }}"><img class="card-img-top mb-3" src="{{ asset('storage/' . App\Image::find($p->featured_img)->url ) }}" alt="{{ $p->name }}" title="{{ $p->name }}"></a>
                    <h3><a href="{{ route('shop.product', $p->id) }}">{{ $p->name }}</a></h3>
                    <p class="price">
                        @if (!$p->sale_price)
                            €{{ $p->price }}
                        @else
                            €{{ $p->sale_price }}
                        @endif
                    </p>
                </div>
                <!--/.Product -->
            @endforeach
        </div>
        <!--/.Row -->
    </section>
    <!--/.Product List -->
</div>
<!--/.Container -->
@endsection

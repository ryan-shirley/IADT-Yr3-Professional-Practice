@extends('layouts.app')

@section('content')

<section class="image-title">
    <div class="content-wrapper">
        <div class="inner">
            <h1>Shop</h1>
        </div>
    </div>
</section>
<!--/.Image Title -->

<div class="container">
    <ul class="nav nav-pills justify-content-center shop-nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('shop.home') }}">All Products</a>
        </li>
        @foreach ($categories as $cat)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('shop.category.all', $cat->id) }}">{{ $cat->name }}</a>
        </li>
        @endforeach
    </ul>
    <!--/.Row -->

    @component('components.list-products', [
        'products' => $products
    ])
    @endcomponent
    <!--/.Product List -->
</div>
<!--/.Container -->
@endsection

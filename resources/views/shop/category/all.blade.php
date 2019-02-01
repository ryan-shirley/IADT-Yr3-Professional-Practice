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

    @if (count($category->products) != 0)
        @component('components.list-products', [
            'products' => $category->products
        ])
        @endcomponent
        <!--/.Product List -->
    @else
        <div class="alert alert-danger" role="alert">
            There are no products for this category.
        </div>
    @endif

</div>
<!--/.Container -->
@endsection

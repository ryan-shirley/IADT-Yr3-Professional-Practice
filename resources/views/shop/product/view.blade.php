@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <p>
                <a href="{{ route('shop.home') }}">Shop</a>    /    {{ $product->name }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" alt="{{ App\Image::find($product->featured_img)->title }}" title="{{ App\Image::find($product->featured_img)->title }}" />
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>
                €{{ $product->price }} EUR
            </p>
            <p>
                €{{ $product->sale_price }} EUR
            </p>
            <hr />

            <form action="{{ route('cart.add')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-dark">Add to cart</button>

                <br /><br />

                <p>
                    {{ $product->description }}
                </p>
            </form>

        </div>
    </div>

</div>
@endsection

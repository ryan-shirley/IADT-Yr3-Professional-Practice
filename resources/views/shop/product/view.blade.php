@extends('layouts.app')

@section('content')
<div class="container-fluid full-width single-product">
    <div class="row no-gutters justify-content-md-center">
        <div class="col-lg-6 col-md-8">
            <img class="img-fluid" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" alt="{{ App\Image::find($product->featured_img)->title }}" title="{{ App\Image::find($product->featured_img)->title }}" />

            @foreach ($product->images as $image)
                <img class="img-fluid" src="{{ asset('storage/' . $image->url ) }}" alt="{{ $image->title }}" title="$image->title }}" />
            @endforeach
        </div>
        <div class="col-lg-6">
            <div class="content">
                <div class="inner">
                    <h1>{{ $product->name }}</h1>
                    <p class="description">
                        {{ $product->description }}
                    </p>
                    <p class="meta">Meta:
                        @foreach ($product->tags as $tag)
                            {{ $tag->name }},
                        @endforeach

                        @foreach ($product->categories as $c)
                            {{ $c->name }}
                            @if(!$loop->last)
                                ,
                             @endif
                        @endforeach
                    </p>
                    <hr />
                    <p class="price">
                        @if (!$product->sale_price)
                            €{{ $product->price }}
                        @else
                            €{{ $product->sale_price }}
                        @endif
                    </p>
                    <form action="{{ route('cart.add')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-dark">Add to cart</button>
                    </form>
                    <!--/.Add to cart -->
                </div>
            </div>
            <!--/.Content -->
        </div>
    </div>
    <!--/.Row -->
</div>
<!--/.Container -->
@endsection

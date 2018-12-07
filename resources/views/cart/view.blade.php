@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Shopping cart</div>
                <div class="card-body">
                    @if ($cart->isEmpty())
                    <p>There are no items in your shopping cart</p>
                    @else
                    <p>
                        <a href="{{ route( 'cart.edit' ) }}" class="btn btn-warning">Edit cart</a>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-secondary">Checkout</a>
                    </p>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->getItems() as $item)
                            <tr>
                                <td><img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($item->getProduct()->featured_img)->url ) }}" alt="{{ App\Image::find($item->getProduct()->featured_img)->title }}" title="{{ App\Image::find($item->getProduct()->featured_img)->title }}" /></td>
                                <td>{{ $item->getProduct()->name }}</td>
                                <td>{{ number_format($item->getProduct()->price, 2) }}</td>
                                <td>{{ $item->getQuantity() }}</td>
                                <td>{{ number_format($item->getTotalPrice(), 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="product_id" value="{{ $item->getProduct()->id }}">
                                        <button class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>Total price: {{ $cart->getTotalPrice() }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

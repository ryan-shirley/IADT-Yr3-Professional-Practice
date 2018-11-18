@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit shopping cart</div>
                <div class="card-body">
                    @if ($cart->isEmpty())
                    <p>There are no items in your shopping cart</p>
                    @else
                    <form method="POST" action="{{ route('cart.update') }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->getItems() as $item)
                                <tr>
                                    <td><img class="img-thumbnail" style="max-width:100px;" src="{{ App\Image::find($item->getProduct()->featured_img)->url }}" alt="{{ App\Image::find($item->getProduct()->featured_img)->title }}" title="{{ App\Image::find($item->getProduct()->featured_img)->title }}" /></td>
                                    <td>{{ $item->getProduct()->name }}</td>
                                    <td>{{ number_format($item->getProduct()->price, 2) }}</td>
                                    <td><input type="text" name="quantity[{{ $item->getProduct()->id }}]" value="{{ $item->getQuantity() }}" /></td>
                                    <td>{{ number_format($item->getTotalPrice(), 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p>Total price: {{ $cart->getTotalPrice() }}</p>
                        <p><button type="submit" class="btn btn-dark">Update</button></p>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

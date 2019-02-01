@extends('layouts.app')

@section('content')
<div class="container shopping-cart">

    <h1>Your Shopping Cart</h1>

    <a href="{{ route( 'cart.edit' ) }}" class="btn btn-warning mb-3">Edit cart</a>

    @if ($cart->isEmpty())
    <p>There are no items in your shopping cart</p>
    @else

        <table class="table">
            <tbody>
                @foreach ($cart->getItems() as $item)
                <tr class="item">
                    <td><img src="{{ asset('storage/' . App\Image::find($item->getProduct()->featured_img)->url ) }}" alt="{{ App\Image::find($item->getProduct()->featured_img)->title }}" title="{{ App\Image::find($item->getProduct()->featured_img)->title }}" /></td>
                    <td class="align-middle"><h4>{{ $item->getProduct()->name }}</h4></td>
                    <td class="align-middle price">{{ number_format($item->getProduct()->price, 2) }} €</td>
                    <td class="align-middle">{{ $item->getQuantity() }}</td>
                    <td class="align-middle">
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="product_id" value="{{ $item->getProduct()->id }}">
                            <button class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!--/.Shopping Cart Table -->

        <p class="price text-right">Total: {{ $cart->getTotalPrice() }} €</p>
        <a href="{{ route('cart.checkout') }}" class="btn btn-secondary float-right">Checkout</a>

    @endif
</div>
<!--/.Container -->
@endsection

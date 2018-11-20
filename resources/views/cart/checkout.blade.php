@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Checkout</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('cart.pay') }}">
                        @csrf
                        
                        <h4>Contact Information</h4>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <hr />
                        <h4>Shipping Information</h4>
                        <div class="form-group">
                            @foreach ($user->addresses as $address)
                                @if ($address->shipping == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping" value="{{ $address->id }}" >
                                        <label class="form-check-label" for="{{ $address->id }}">
                                        {{ $address->line1 }}
                                        </label>
                                    </div>

                                @endif
                            @endforeach
                        </div>
                        <hr />
                        <h4>Billing Information</h4>
                        <div class="form-group">
                            @foreach ($user->addresses as $address)
                                @if ($address->billing == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping" value="{{ $address->id }}" >
                                        <label class="form-check-label" for="{{ $address->id }}">
                                        {{ $address->line1 }}
                                        </label>
                                    </div>

                                @endif
                            @endforeach
                        </div>
                        <hr />
                        <h4>Shipping Method</h4>
                        <div class="form-group">
                            options
                        </div>
                        <hr />
                        <h4>Payment Information</h4>
                        <div class="form-group">
                            <label for="card-number">card number</label>
                            <input type="text" name="card-number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="card-holder-name">card holder name</label>
                            <input type="text" name="card-holder-name" class="form-control">
                        </div>
                        <hr />
                        <button type="submit" class="btn btn-primary">Purchase</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->getItems() as $item)
                            <tr>
                                <td>{{ $item->getQuantity() }}<img class="img-thumbnail" style="max-width:100px;" src="{{ App\Image::find($item->getProduct()->featured_img)->url }}" alt="{{ App\Image::find($item->getProduct()->featured_img)->title }}" title="{{ App\Image::find($item->getProduct()->featured_img)->title }}" /></td>
                                <td>{{ $item->getProduct()->name }}</td>
                                <td>{{ number_format($item->getProduct()->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>Total price: {{ $cart->getTotalPrice() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

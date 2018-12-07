@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Checkout</div>
                <div class="card-body">
                    @if ($cart->isEmpty())
                    <p>There are no items in your shopping cart</p>
                    @else
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('cart.pay') }}">
                        @csrf

                        <h4>Shipping Information (make radio active on error)</h4>
                        <div class="form-group">
                            @foreach ($user->addresses as $address)
                                @if ($address->shipping == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping_id" value="{{ $address->id }}" @if(old('shipping_id') == $address->id) checked @endif />
                                        <label class="form-check-label" for="{{ $address->id }}">
                                        {{ $address->line1 }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach

                            <div class="form-group">
                                <label>
                                    <input type="radio" name="shipping_id" value="0" @if(old('shipping_id') == 0) checked @endif />
                                    Enter the details for a new shipping address
                                </label>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Address</td>
                                            <td><textarea class="form-control" type="text" name="shipping_address_line1">{{ old('shipping_address_line1') }}</textarea></td>
                                            <td>{{ ($errors->has('shipping_address_line1')) ? $errors->first('shipping_address_line1') : "" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if ($errors->has('shipping_id'))
                                <span class="badge badge-pill badge-danger">{{ $errors->first('shipping_id') }}</span>
                            @endif
                        </div>
                        <hr />
                        <h4>Billing Information (make radio active on error)</h4>
                        <div class="form-group">
                            @foreach ($user->addresses as $address)
                                @if ($address->billing == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="billing_id" value="{{ $address->id }}" @if(old('billing_id') == $address->id) checked @endif />
                                        <label class="form-check-label" for="{{ $address->id }}">
                                        {{ $address->line1 }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach

                            <div class="form-group">
                                <label>
                                    <input type="radio" name="billing_id" value="0" @if(old('billing_id') == 0) checked @endif />
                                    Enter the details for a new billing address
                                </label>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Address</td>
                                            <td><textarea class="form-control" type="text" name="billing_address_line1">{{ old('billing_address_line1') }}</textarea></td>
                                            <td>{{ ($errors->has('billing_address_line1')) ? $errors->first('billing_address_line1') : "" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if ($errors->has('billing_id'))
                                <span class="badge badge-pill badge-danger">{{ $errors->first('billing_id') }}</span>
                            @endif
                        </div>
                        <hr />
                        <h4>Shipping Method (make radio active on error)</h4>
                        <div class="form-group">
                            @foreach ($shipping_methods as $method)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping_method_id" value="{{ $method->id }}" >
                                        <label class="form-check-label" for="{{ $method->id }}">
                                        {{ $method->name }} -  €{{ $method->cost }}
                                        </label>
                                    </div>
                            @endforeach
                            @if ($errors->has('shipping_method_id'))
                                <span class="badge badge-pill badge-danger">{{ $errors->first('shipping_method_id') }}</span>
                            @endif
                        </div>
                        <hr />
                        <h4>Payment Information (not validated)</h4>
                        <div class="form-group">
                            <label for="card-number">card number</label>
                            <input type="text" name="card_number" class="form-control" value="{{ old( 'card_number') }}">
                            <span class="badge badge-pill badge-danger">{{ $errors->first('card_number') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="card-holder-name">card holder name</label>
                            <input type="text" name="card_holder_name" class="form-control" value="{{ old( 'card_holder_name') }}">
                            <span class="badge badge-pill badge-danger">{{ $errors->first('card_holder_name') }}</span>
                        </div>
                        <hr />
                        <button type="submit" class="btn btn-primary">Purchase</button>
                    </form>
                    @endif
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
                    <hr />
                    <p>Shipping: - (need jquery to update this)</p>
                    <p>Total price: {{ $cart->getTotalPrice() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

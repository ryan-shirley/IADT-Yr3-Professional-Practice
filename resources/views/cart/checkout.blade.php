@extends('layouts.app')

@section('content')

<div class="container-fluid checkout">
    <div class="row">
        <div class="col-md-8 bg-light">

            <div class="inner">
                <div id="errors">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div id="checkout_nav" class="navigation">
                    <p>
                        <span class="address">Shipping Information</span><span class="seperator">></span><span class="shipping">Shipping Method</span><span class="seperator">></span><span class="payment">Payment method</span>
                    </p>
                </div>
                <!--/.Checkout Naviagtion -->

                <form method="POST" action="{{ route('cart.pay') }}">
                    @csrf
                    <div id="address" class="addresses">

                        <div class="shipping">
                            <h3>Shipping Address</h3>

                            <div class="form-group">
                                @foreach ($user->addresses as $address)
                                    @if ($address->shipping == true)
                                        @component('components.checkout.address', [
                                            'name' => 'shipping_id',
                                            'title' => $address->line1,
                                            'value' => $address->id
                                        ])
                                        @endcomponent
                                    @endif
                                @endforeach

                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="shipping_id" value="0" @if(old('shipping_id') == 0) @endif />
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
                            <!--/.Form Group -->
                        </div>
                        <!--/.Shipping Address -->

                        <div class="billing">
                            <h3>Billing Address</h3>

                            <div class="form-group">
                                @foreach ($user->addresses as $address)
                                    @if ($address->billing == true)
                                        @component('components.checkout.address', [
                                            'name' => 'billing_id',
                                            'title' => $address->line1,
                                            'value' => $address->id
                                        ])
                                        @endcomponent
                                    @endif
                                @endforeach

                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="billing_id" value="0" @if(old('billing_id') == 0) @endif />
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
                            <!--/.Form Group -->
                        </div>
                        <!--/.Billing Address -->

                    </div>
                    <!--/.Address -->

                    <div id="shipping" class="shipping">

                        <div class="methods">
                            <h3>Shipping Method</h3>

                            <div class="form-group">
                                @foreach ($shipping_methods as $method)
                                    @component('components.checkout.shipping-method', [
                                        'name' => 'shipping_method_id',
                                        'title' => $method->name,
                                        'value' => $method->id,
                                        'cost' => $method->cost
                                    ])
                                    @endcomponent
                                @endforeach

                                @if ($errors->has('shipping_method_id'))
                                    <span class="badge badge-pill badge-danger">{{ $errors->first('shipping_method_id') }}</span>
                                @endif
                            </div>
                            <!--/.Form Group -->
                        </div>
                        <!--/.Methods -->
                    </div>
                    <!--/.Shipping -->

                    <div id="payment" class="shipping">

                        <div class="methods">
                            <h3>Payment Method</h3>

                            <div class="form-group">
                                @foreach ($user->cards as $card)
                                    @component('components.checkout.card', [
                                        'name' => 'card_id',
                                        'card' => $card
                                    ])
                                    @endcomponent
                                @endforeach

                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="card_id" value="0" @if(old('card_id') == 0) @endif />
                                        Enter the details for a new card
                                    </label>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>card number</td>
                                                <td><input type="text" name="card_number" class="form-control" value="{{ old( 'card_number') }}"></td>
                                                <td>{{ ($errors->has('card_number')) ? $errors->first('card_number') : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>card holder name</td>
                                                <td><input type="text" name="card_holder_name" class="form-control" value="{{ old( 'card_holder_name') }}"></td>
                                                <td>{{ ($errors->has('card_holder_name')) ? $errors->first('card_holder_name') : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>expiry</td>
                                                <td><input type="text" name="expiry" class="form-control" value="{{ old( 'expiry') }}"></td>
                                                <td>{{ ($errors->has('expiry')) ? $errors->first('expiry') : "" }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                @if ($errors->has('card_id'))
                                    <span class="badge badge-pill badge-danger">{{ $errors->first('card_id') }}</span>
                                @endif
                            </div>
                            <!--/.Form Group -->
                        </div>
                        <!--/.Methods -->
                    </div>
                    <!--/.Shipping -->

                    <button type="submit" class="btn btn-primary">Purchase</button>

                </form>
                <!--/.Form Checkout -->
            </div>
            <!--/.Inner -->

        </div>
        <!--/.Col -->
        <div class="col-md-4">
            @component('components.checkout.list-products', [
                'items' => $cart->getItems()
            ])
            @endcomponent
            <hr />
            <p>Shipping: - (need jquery to update this)</p>
            <p>Total price: {{ $cart->getTotalPrice() }}</p>
        </div>
        <!--/.Col -->
    </div>
    <!--/.Row -->
</div>
<!--/.Container fluid -->

@endsection

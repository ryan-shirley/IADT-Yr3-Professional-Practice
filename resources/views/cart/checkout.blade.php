@extends('layouts.app')

@section('content')

<div class="container-fluid checkout">
    <div class="row">
        <div class="col-lg-8 bg-light">

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
                            <div class="row">
                                <div class="col-10">
                                    <h3>Shipping Address</h3>
                                </div>
                                <!--/.Col -->
                                <div class="col-2">
                                    <!-- Button trigger modal -->
                                    <button id="add_shipping_address_btn" type="button" class="btn ajax-create-btn" data-toggle="modal" data-target="#newShippingAddressModal">
                                      +
                                    </button>
                                </div>
                                <!--/.Col -->
                            </div>
                            <!--/.Row -->

                            <!-- New Shipping Address Modal -->
                            <div class="modal fade" id="newShippingAddressModal" tabindex="-1" role="dialog" aria-labelledby="newShippingAddressModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newShippingAddressModalLabel">Create Shipping Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!--/.Modal Header -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <!-- <label>
                                                    <input type="radio" name="shipping_id" value="0" @if(old('shipping_id') == 0) @endif />
                                                </label> -->
                                                <textarea id="shipping_address_line1" class="form-control" type="text" name="shipping_address_line1"></textarea>
                                                <input id="shipping_user_id" value="{{ $user->id }}" hidden />

                                                <span class="error"></span>
                                            </div>
                                            <!--/.Form Group -->
                                        </div>
                                        <!--/.Modal Body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button id="submit_shipping_address" type="button" class="btn btn-primary">Add</button>
                                        </div>
                                        <!--/.Modal Footer -->
                                    </div>
                                    <!--/.Modal Content -->
                                </div>
                                <!--/.Modal Dialog -->
                            </div>
                            <!--/.Shipping Address Modal -->

                            <div id="list_shipping_address" class="form-group">
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


                                @if ($errors->has('shipping_id'))
                                    <span class="badge badge-pill badge-danger">{{ $errors->first('shipping_id') }}</span>
                                @endif
                            </div>
                            <!--/.Form Group -->
                        </div>
                        <!--/.Shipping Address -->

                        <div class="billing">
                            <div class="row">
                                <div class="col-10">
                                    <h3>Billing Address</h3>
                                </div>
                                <!--/.Col -->
                                <div class="col-2">
                                    <!-- Button trigger modal -->
                                    <button id="add_billing_address_btn" type="button" class="btn ajax-create-btn" data-toggle="modal" data-target="#newBillingAddressModal">
                                      +
                                    </button>
                                </div>
                                <!--/.Col -->
                            </div>
                            <!--/.Row -->

                            <!-- New Billing Address Modal -->
                            <div class="modal fade" id="newBillingAddressModal" tabindex="-1" role="dialog" aria-labelledby="newBillinggAddressModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newBillingAddressModalLabel">Create Billing Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!--/.Modal Header -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <!-- <label>
                                                    <input type="radio" name="shipping_id" value="0" @if(old('shipping_id') == 0) @endif />
                                                </label> -->
                                                <textarea id="billing_address_line1" class="form-control" type="text" name="billing_address_line1"></textarea>
                                                <input id="billing_user_id" value="{{ $user->id }}" hidden />

                                                <span class="error"></span>
                                            </div>
                                            <!--/.Form Group -->
                                        </div>
                                        <!--/.Modal Body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button id="submit_billing_address" type="button" class="btn btn-primary">Add</button>
                                        </div>
                                        <!--/.Modal Footer -->
                                    </div>
                                    <!--/.Modal Content -->
                                </div>
                                <!--/.Modal Dialog -->
                            </div>
                            <!--/.Shipping Address Modal -->

                            <div id="list_billing_address" class="form-group">
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
                                        'description' => $method->description,
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
                            <div class="row">
                                <div class="col-10">
                                    <h3>Payment Method</h3>
                                </div>
                                <!--/.Col -->
                                <div class="col-2">
                                    <!-- Button trigger modal -->
                                    <button id="add_card_btn" type="button" class="btn ajax-create-btn" data-toggle="modal" data-target="#newCardModal">
                                      +
                                    </button>
                                </div>
                                <!--/.Col -->
                            </div>
                            <!--/.Row -->

                            <!-- New Card Modal -->
                            <div class="modal fade" id="newCardModal" tabindex="-1" role="dialog" aria-labelledby="newCardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newCardModalLabel">Create Card</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!--/.Modal Header -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Card Number</label>
                                                <input id="card_number" type="text" name="card_number" class="form-control">
                                                <span id="card_number_error" class="badge badge-danger"></span>
                                                <br />

                                                <label>Card Holder Name</label>
                                                <input id="card_holder_name" type="text" name="card_holder_name" class="form-control">
                                                <span id="card_name_error" class="badge badge-danger"></span>
                                                <br />

                                                <td>Expiry</td>
                                                <input id="expiry" type="text" name="expiry" class="form-control">
                                                <span id="card_expiry_error" class="badge badge-danger"></span>
                                                <br />

                                                <input id="card_user_id" value="{{ $user->id }}" hidden />
                                            </div>
                                            <!--/.Form Group -->
                                        </div>
                                        <!--/.Modal Body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button id="submit_card" type="button" class="btn btn-primary">Add</button>
                                        </div>
                                        <!--/.Modal Footer -->
                                    </div>
                                    <!--/.Modal Content -->
                                </div>
                                <!--/.Modal Dialog -->
                            </div>
                            <!--/.Card Modal -->


                            <div class="form-group">
                                <div class="row">
                                    <div id="card_list" class="col-md-10">
                                        @foreach ($user->cards as $card)
                                            @component('components.checkout.card', [
                                                'name' => 'card_id',
                                                'card' => $card
                                            ])
                                            @endcomponent
                                        @endforeach
                                    </div>
                                    <!--/.Col -->
                                </div>
                                <!--/.Row -->

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
        <div class="col-lg-4">
            <div class="cart sticky-top">
                @component('components.checkout.list-products', [
                    'items' => $cart->getItems()
                ])
                @endcomponent
                <div class="d-flex justify-content-between mt-3">
                    <div>
                        Sub total
                    </div>
                    <div>
                        <span id="cart_sub_total">{{ number_format($cart->getTotalPrice(),2) }}</span>
                    </div>
                </div>
                <!--/.Flexbox -->
                <div class="d-flex justify-content-between">
                    <div>
                        Shipping
                    </div>
                    <div>
                        <span id="cart_shipping_price">-</span>
                    </div>
                </div>
                <!--/.Flexbox -->
                <hr />
                <div class="d-flex justify-content-between">
                    <div>
                        Total
                    </div>
                    <div>
                        <span  id="cart_total">{{ number_format($cart->getTotalPrice(),2) }} €</span>
                    </div>
                </div>
                <!--/.Flexbox -->
            </div>
            <!--/.Cart -->
        </div>
        <!--/.Col -->
    </div>
    <!--/.Row -->
</div>
<!--/.Container fluid -->

@endsection

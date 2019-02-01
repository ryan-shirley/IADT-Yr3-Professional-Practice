@extends('layouts.app')

@section('content')
<div class="container confirmation">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="h4 mb-4 mt-5"><span>{{ $order->id }}</span> Order <strong>{{ number_format($order->total(),2) }} €</strong></p>
            <hr />

            <p class="mt-5 mb-5">This order has created and is now being processed. The payment method cannot be changed.</p>
            <hr />

            <div class="row mb-5">
                <div class="col-lg-6">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Amount</small>
                        </div>
                        <div>
                            <strong>{{ number_format($order->total(),2) }} €</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Delivery</small>
                        </div>
                        <div>
                            <strong>{{ $order->shipping_method->name }} {{ $order->shipping_method->description }} - {{ $order->shipping_method->cost }} €</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                </div>
                <!--/.Col -->
                <div class="col-lg-6">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Processed On</small>
                        </div>
                        <div>
                            <strong>{{ date("d-m-Y", strtotime($order->order_date) ) }}</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Paid With</small>
                        </div>
                        <div>
                            <strong>VISA</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                </div>
                <!--/.Col -->
            </div>
            <!--/.Row -->

            <p class="h4 mb-5">{{ $order->totalItems() }} Items in your order</p>

            <div class="row mb-5">
                @foreach ($order->products as $product)
                    <div class="col-lg-4 col-sm-6">
                        <div class="row product">
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" />
                            </div>
                            <!--/.Col -->
                            <div class="col-6">
                                <p class="mb-0"><small><strong>{{ $product->name }}</strong></small></p>
                                <p class="mb-0"><small>x {{ $product->pivot->quantity }}</small></p>
                                <p><small>{{ $product->pivot->price }} €</small></p>
                            </div>
                            <!--/.Col -->
                        </div>
                        <!--/.Row -->
                    </div>
                    <!--/.Col -->
                @endforeach
            </div>
            <!--/.Row -->

            <p class="h4 mb-5">Delivery address</p>
            <div class="row mb-5">
                <div class="d-flex justify-content-between col-xl-6">
                    <div>
                        <small>Address</small>
                    </div>
                    <div>
                        <strong>{{ $order->shipping_address }}</strong>
                    </div>
                </div>
                <!--/.Flexbox -->
            </div>
            <!--/.Row -->

        </div>
        <!--/.Col -->
    </div>
    <!--/.Row -->
</div>
<!--/.Container -->
@endsection

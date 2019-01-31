@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="h4 mb-4 mt-5"><span>{{ $order->id }}</span> Order <strong>{{ $order->total() }} €</strong></p>
            <hr />

            <p class="mt-5 mb-5">This order has created and is now being processed. The payment method cannot be changed.</p>
            <hr />

            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <div>
                            Total Amount
                        </div>
                        <div>
                            <strong>{{ $order->total() }} €</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                    <div class="d-flex justify-content-between">
                        <div>
                            Delivery
                        </div>
                        <div>
                            <strong>{{ $order->shipping_method->name }} {{ $order->shipping_method->description }} - {{ $order->shipping_method->cost }} €</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                </div>
                <!--/.Col -->
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <div>
                            Processed On
                        </div>
                        <div>
                            <strong>{{ date("d-m-Y", strtotime($order->order_date) ) }}</strong>
                        </div>
                    </div>
                    <!--/.Flexbox -->
                    <hr />
                    <div class="d-flex justify-content-between">
                        <div>
                            Paid With
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
                    <div class="col-md-4">
                        <div class="row">
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
                <div class="d-flex justify-content-between col-6">
                    <div>
                        Address
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Congratulations!<br />Your order has been placed</h1>
                    <h3>Order #{{ $order->id }}</h3>

                    <p>
                        {{ $order->user->name }} your order is now being processed and our team will do their
                        best to get it to you as soon as possible. You can see your order
                        details below. Any questions email us at hello@example.com
                    </p>

                    <hr />

                    <h5>Shipping Address</h5>
                    <hr />
                    <pre>{{ $order->shipping_address }}</pre>

                    <h5>Order Total</h5>
                    <hr />
                    <p>Sub-Total: €{{ $order->subTotal() }}</p>
                    <p>Shipping: €{{ $order->shipping_method->cost }}</p>
                    <p>Total: €{{ $order->total() }}</p>

                    <table class="table">
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product->pivot->quantity }}<img class="img-thumbnail" style="max-width:100px;" src="{{ asset('storage/' . App\Image::find($product->featured_img)->url ) }}" /></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

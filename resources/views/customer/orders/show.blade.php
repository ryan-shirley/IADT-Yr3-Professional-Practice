@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.customermenu')

<div class="col-md-9">
  <div class="card">
      <div class="card-header">Order Details</div>
      <div class="card-body">
          <p class="h2">Order #{{ $order->id }}</p>
          <p class="h5">{{ $order->order_date }} at {{ $order->order_time }}</p>
          <hr>
          <div class="row">

            <div class="col">
              @foreach ($order->products as $product)
              <div class="row">
                <div class="col">{{ $product->name }}</div>
                <div class="col">&euro;{{ $product->pivot->price }}</div>
                <div class="col">x {{ $product->pivot->quantity }}</div>
                <div class="col">&euro;{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</div>
              </div>
              @endforeach
            </div>

            <div class="col">
              <p class="h3">{{ $order->fulfillment_status }}</p>
              <p class="">Your order is on the way! <br/> Tracking no. <a href=""><u>123213213213</u></a></p>
            </div>

          </div>

          <div class="row">
            <div class="col">
              <p class="h3">{{ $order->payment_status }}</p>
              <div class="row small">
                <div class="col-3">Sub Total</div>
                <div class="col-7">1 item</div>
                <div class="col-2 text-right">65.00</div>
              </div>

              <div class="row small">
                <div class="col-3">Shipping</div>
                <div class="col-7">{{ App\ShippingMethod::find($order->shipping_method_id)->name }}</div>
                <div class="col-2 text-right">0.00</div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="col-12 my-2" style="border-top: 1px solid black;"></div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <strong>Total</strong>
                </div>
                <div class="col text-right">
                  <strong>0.00</strong>
                </div>
              </div>


            </div>

            <div class="col">
              <p class="h4">Shipping Address</p>
              <p class="">{{ $order->shipping_address }}</p>
              <p class="h4 mt-3">Billing Address</p>
              <p class="">{{ $order->billing_address }}</p>
            </div>

          </div>

          <h2>Timeline</h2>

          <table class="table">
            <tbody>
              @foreach ($order->events->reverse() as $event)
              <tr>
                <td scope="col">{{ $event->name }}</td>
                <td scope="col">{{ $event->created_at }}</td>
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

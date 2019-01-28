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

          <div class="row pt-3">
            <div class="col">
              @foreach ($order->products as $product)

              <table class="table">
                <tbody>
                  <tr>
                    <td scope="col">{{ $product->name }}</td>
                    <td scope="col">&euro;{{ $product->pivot->price }}</td>
                    <td scope="col"> x </td>
                    <td scope="col">{{ $product->pivot->quantity }}</td>
                    <td scope="col">&euro;{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                  </tr>
                </tbody>
              </table>
              @endforeach
            </div>

            <div class="col">
              <p class="h3">{{ $order->fulfillment_status }}</p>
              <p class="">Your order is on the way! <br/> Tracking no. <a href=""><u>123213213213</u></a></p>
              <br/>
              <p class="h4 mt-3">Billing Address</p>
              <p class="">{{ $order->billing_address }}</p>
            </div>

          </div>

          <div class="row">
            <div class="col">
              <p class="h3">{{ $order->payment_status }}</p>
              <p class="">
                Sub Total <br/>
                Shipping {{ App\ShippingMethod::find($order->shipping_method_id)->name }}<br/>
                <strong>Total</strong>
              </p>
            </div>

            <div class="col">
              <p class="h4">Shipping Address</p>
              <p class="">{{ $order->shipping_address }}</p>

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

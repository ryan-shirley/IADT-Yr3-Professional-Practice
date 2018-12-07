@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @include('layouts.artistmenu')

    <div class="col-md-9">
      <div class="card">
          <div class="card-header">Order Details</div>
          <div class="card-body">
              <table class="table">
                  <tbody>
                      <tr>
                          <td scope="col">Order #</td>
                          <td scope="row">{{ $order->id }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Customer</td>
                          <td>{{ $order->user->name }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Order Date</td>
                          <td>{{ $order->order_date }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Fulfillment Date</td>
                          <td>{{ $order->fulfillment_date }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Payment Status</td>
                          <td>{{ $order->payment_status }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Fulfillment Status</td>
                          <td>{{ $order->fulfillment_status }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Shipping Address</td>
                          <td>{{ $order->shipping_address }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Billing Address</td>
                          <td>{{ $order->billing_address }}</td>
                      </tr>
                      <tr>
                          <td scope='col'>Shipping Method</td>
                          <td>{{ App\ShippingMethod::find($order->shipping_method_id)->name }}</td>
                      </tr>
                  </tbody>
              </table>
              <hr>
              <h2>Products</h2>
              <table class="table">
                <thead>
                  <tr>
                    <td scope='col'>Product</td>
                    <td scope='col'>Price</td>
                    <td scope='col'>Description</td>
                    <td scope='col'>Quantity</td>
                    <td scope='col'>Total</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->products as $product)
                  <tr>
                    <td scope="col">{{ $product->name }}</td>
                    <td scope="col">&euro;{{ $product->pivot->price }}</td>
                    <td scope="col">{{ $product->description }}</td>
                    <td scope="col">{{ $product->pivot->quantity }}</td>
                    <td scope="col">&euro;{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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
</div>
@endsection

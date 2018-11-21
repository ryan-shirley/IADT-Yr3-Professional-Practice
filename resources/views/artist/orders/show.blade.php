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
                          <td>{{ $order->user_id }}</td>
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
              <table class="table">
                <thead>
                  <tr>
                    <td scope='col'>Product</td>
                    <td scope='col'>Price</td>
                    <td scope='col'>Sale Price</td>
                    <td scope='col'>Description</td>
                    <td scope='col'>Quantity</td>
                    <td scope='col'>Total</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Product1</th>
                    <td>19.99</td>
                    <td>14.99</td>
                    <td>This is some info about the product</td>
                    <td>3</td>
                    <td>59.97</td>
                  </tr>
                  <tr>
                    <th scope="row">Product2</th>
                    <td>19.99</td>
                    <td>14.99</td>
                    <td>This is some info about the product</td>
                    <td>3</td>
                    <td>59.97</td>
                  </tr>
                  <tr>
                    <th scope="row">Product3</th>
                    <td>19.99</td>
                    <td>14.99</td>
                    <td>This is some info about the product</td>
                    <td>3</td>
                    <td>59.97</td>
                  </tr>
                </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection

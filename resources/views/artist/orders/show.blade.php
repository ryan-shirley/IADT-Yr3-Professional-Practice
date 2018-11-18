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
                          <td>{{ $order->shipping_method_id }}</td>
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

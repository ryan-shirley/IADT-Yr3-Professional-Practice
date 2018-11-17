@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">Artist Home</div>
        <div class="card-body">
          <ul>
            <li><a href="{{ route('artist.home') }}">Home</a></li>
            <li>Orders</li>
            <ul>
              <li>All Orders</li>
              <li>Active Orders</li>
              <li>Completed Orders</li>
            </ul>
            <li>Products</li>
            <ul>
              <li><a href="{{ route('products.index') }}">All Products</a></li>
              <li><a href="{{ route('categories.index') }}">Categories</a></li>
              <li><a href="{{ route('tags.index') }}">Tags</a></li>
            </ul>
            <li>Account Settings</li>
            <li>Logout</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Orders</div>
            <div class="card-body">
                <a class="btn btn-primary" href="" role="button">Create Order (Not working atm)</a>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <td scope="col">Order #</td>
                        <td scope='col'>Customer</td>
                        <td scope='col'>Order Date</td>
                        <td scope='col'>Fulfillment Date</td>
                        <td scope='col'>Payment Status</td>
                        <td scope='col'>Fulfillment Status</td>
                        <td scope='col'>Shipping Address</td>
                        <td scope='col'>Billing Address</td>
                        <td scope='col'>Shipping Method</td>
                        <td scope='col'>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td scope="row">{{ $order->id }}</td>
                            <td>{{ $order->user_id }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->fulfillment_date }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->fulfillment_status }}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->billing_address }}</td>
                            <td>{{ $order->shipping_method_id }}</td>
                            <td>

                            </td>
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

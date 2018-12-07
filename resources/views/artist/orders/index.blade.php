@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @include('layouts.artistmenu')

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Orders</div>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" href="" role="button">Create Order (Not working atm)</a>
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
                        @foreach ($orders->reverse() as $order)
                        <tr>
                            <td scope="row">{{ $order->id }}</td>
                            <td>{{ App\User::find($order->user_id)->name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->fulfillment_date }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->fulfillment_status }}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->billing_address }}</td>
                            <td>{{ App\ShippingMethod::find($order->shipping_method_id)->name }}</td>
                            <td>
                              <a href="{{ route('artist.orders.show', $order) }}">View</a>
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

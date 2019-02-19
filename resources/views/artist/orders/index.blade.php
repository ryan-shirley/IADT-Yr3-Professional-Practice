@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.artistmenu')

<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <p class="h2">All Orders</p>
            <a class="btn btn-outline-dark btn-sm mb-2" href="{{ route('orders.create') }}" role="button">Create Order</a>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <td scope="col"><h5>Order #</h5></td>
                    <td scope='col'><h5>Customer</h5></td>
                    <td scope='col'><h5>Order Date</h5></td>
                    <td scope='col'><h5>Payment Status</h5></td>
                    <td scope='col'><h5>Fulfillment Status</h5></td>
                    <!-- <td scope='col'>Shipping Address</td>
                    <td scope='col'>Shipping Method</td> -->
                    <td scope='col'><h5>Actions</h5></td>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders->reverse() as $order)
                    <tr>
                        <td scope="row">{{ $order->id }}</td>
                        <td>{{ App\User::find($order->user_id)->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->fulfillment_status }}</td>
                        <!-- <td>{{ $order->shipping_address }}</td>
                        <td>{{ App\ShippingMethod::find($order->shipping_method_id)->name }}</td> -->
                        <td>
                          <a href="{{ route('orders.show', $order) }}">View</a>
                          <a href="{{ route('orders.edit', $order) }}" class="btn btn-dark">Edit</a>
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
@endsection

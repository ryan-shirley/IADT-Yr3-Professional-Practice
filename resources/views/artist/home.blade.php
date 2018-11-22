@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">

  @include('layouts.artistmenu')

  <div class="col-md-9">
    <div class="card">
      <div class="card-header">Artist Home</div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        <p class="h2 pb-3"> Hello {{ Auth::user()->name }}! </p>

        <p class="h5"> Recent Products </p>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <td scope='col'>Product Image</td>
                <td scope='col'>Name</td>
                <td scope='col'>Description</td>
                <td scope='col'>price</td>
                <td scope='col'>Created At</td>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <td scope="row">{{ $p->featured_img }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->description }}</td>
                    <td>&euro;{{ $p->price }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="h5"> Recent Orders </p>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <td scope="col">Order #</td>
                <td scope="col">Customer</td>
                <td scope='col'>Date</td>
                <td scope='col'>Status</td>
                <td scope='col'>Total</td>
            </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td scope="row">{{ $order->id }}</td>
                    <td>{{ App\User::find($order->user_id)->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->fulfillment_status }}</td>
                    <td>&euro;{{ $order->total() }}</td>
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

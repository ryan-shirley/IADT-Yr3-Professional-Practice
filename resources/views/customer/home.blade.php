@extends('layouts.app')

@section('content')
<div class="container">

<div class="row">
@include('layouts.customermenu')

<div class="col-md-9">
  <div class="card">
      <div class="card-header">Customer Home</div>

      <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif
          <!-- You are logged in! -->

          <p class="h2">Hello {{ Auth::user()->name }}!</p>

          <p class="h5"> Recent Orders </p>
          <table class="table">
              <thead class="thead-light">
              <tr>
                  <td scope="col">Order #</td>
                  <td scope='col'>Date</td>
                  <td scope='col'>Status</td>
                  <td scope='col'>Total</td>
              </tr>
              </thead>
              <tbody>
                @foreach ($orders->reverse() as $order)
                  @if ($order->user_id == Auth::user()->id)
                  <tr>
                      <td scope="row">{{ $order->id }}</td>
                      <td>{{ $order->order_date }}</td>
                      <td>{{ $order->fulfillment_status }}</td>
                      <td>&euro;{{ $order->total() }}</td>
                  </tr>
                  @endif
                @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
</div>

</div>
@endsection

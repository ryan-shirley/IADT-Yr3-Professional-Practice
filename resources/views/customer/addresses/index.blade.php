@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@include('layouts.customermenu')

<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <!-- You are logged in! -->

            <p class="h2">Your Address(s) </p>

            <a class="btn btn-outline-dark btn-sm mb-4" href="{{ route('addresses.create') }}">Add new address</a>

            <p class="h5">Your Shipping Address(s) </p>
            <table class="table">
                <thead class="thead-light">
                </thead>
                <tbody>
                    @foreach ($addresses->reverse() as $address)
                      @if ($address->user_id == Auth::user()->id && $address->shipping == 1)
                      <tr>
                          <td scope="row">{{ $address->line1 }}</td>
                          @if ($address->shipping == 1)
                              <td>Shipping Address</td>
                          @else
                              <td>Billing Address</td>
                          @endif
                          <td>

                            <form action="{{ action('Customer\AddressController@destroy', $address->id )}}" method="post">
                                @csrf
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('addresses.edit', $address->id) }}" role="button">Edit</a>
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-outline-dark btn-sm" >Delete</button>
                            </form>
                          </td>
                      </tr>
                      @endif
                    @endforeach
                </tbody>
            </table>
            <p class="h5">Your Billing Address(s) </p>
            <table class="table">
                <thead class="thead-light">
                </thead>
                <tbody>
                    @foreach ($addresses->reverse() as $address)
                      @if ($address->user_id == Auth::user()->id && $address->shipping == 0)
                      <tr>
                          <td scope="row">{{ $address->line1 }}</td>
                          <td>Billing Address</td>
                          <td>

                            <form action="{{ action('Customer\AddressController@destroy', $address->id )}}" method="post">
                                @csrf
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('addresses.edit', $address->id) }}" role="button">Edit</a>
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-outline-dark btn-sm" >Delete</button>
                            </form>
                          </td>
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

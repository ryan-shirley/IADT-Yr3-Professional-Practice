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
            <a href="{{ route('addresses.create') }}">Add new address</a>
            <table class="table">
                <thead class="thead-light">
                </thead>
                <tbody>
                    @foreach ($addresses->reverse() as $address)
                      @if ($address->user_id == Auth::user()->id)
                      <tr>
                          <td scope="row">{{ $address->line1 }}</td>
                          <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('addresses.edit', $address->id) }}" role="button">Edit</a>
                            <form action="{{ action('Customer\AddressController@destroy', $address->id )}}" method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-sm" >Delete</button>
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

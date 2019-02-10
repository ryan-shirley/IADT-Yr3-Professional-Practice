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

<p class="h2">Edit your address </p>

<form method="POST" action="{{ route('addresses.update', $address->id )}}" enctype="multipart/form-data">
  @method('PATCH')
  @csrf
  <div class="form-group">
      <label for="address">New Address</label>
      <input type="text" class="form-control" name="address" value="{{ old( 'address', $address->line1) }}">
      <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">

  </div>
  <div class="form-group text-danger">{{ $errors->first('address') }}</div>
  <button class="form-control btn btn-primary" type="submit" value="Store">Submit</button>
</form>

</div>

</div>
</div>

</div>
</div>
@endsection

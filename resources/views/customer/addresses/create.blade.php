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

<p class="h2">Create your new address </p>

<form method="POST" action="{{ route('addresses.store' )}}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
      <label for="address">New Address</label>
      <input type="text" class="form-control" name="address" placeholder="Enter new address">
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

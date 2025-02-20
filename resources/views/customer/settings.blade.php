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
      <p class="h2">Account Settings</p>
      <table class="mt-3">
          <tbody>
              <tr>
                  <th>Name</th>
                  <td>{{ Auth::user()->name }}</td>
              </tr>
              <tr>
                  <th>Email</th>
                  <td>{{ Auth::user()->email }}</td>
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

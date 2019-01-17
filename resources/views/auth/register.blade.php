@extends('layouts.app')

@section('content')
<div class="auth-form">
    <div class="container">
        <div class="row justify-content-center align-items-center no-gutters">
            <div class="col-md-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>

                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!--/.Name -->
                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!--/.Email -->
                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!--/.Password -->
                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <!--/.Confirm Password -->
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-dark">
                            {{ __('Register') }}
                        </button>
                    </div>
                    <!--/.Register -->
                </form>
            </div>
            <div class="col-md-5">
                <div class="form-helper">
                    <div class="wrapper">
                        <div class="summary">
                            <h4 class="mb-5">valentina bianchi</h4>
                            <h1>Hello there,<br /><strong>welcome to valentina.</strong></h1>
                            <p>
                                Have a question then feel free to get in touch with me!
                            </p>
                        </div>
                        <!--/.Summary -->
                    </div>
                    <!--/.Wrapper -->
                </div>
                <!--/.Form Helper -->
            </div>
        </div>
        <!--/.Row -->
    </div>
    <!--/.Container -->
</div>
<!--/.Auth Form -->
@endsection

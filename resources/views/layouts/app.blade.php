<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>valentina bianchi</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-light navbar-expand-md justify-content-center">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    valentina bianchi
                </a>

                <button id="navbar-burger-icon" class="navbar-toggler ml-1" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="navbar-collapse collapse justify-content-between align-items-center w-100" id="collapsingNavbar">
                    <ul class="navbar-nav mx-auto text-center">
                        @if (Auth::user() == null || Auth::user()->hasRole('customer'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop.home') }}">{{ __('Shop') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.view') }}">{{ __('View cart') }}</a>
                        </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav flex-row justify-content-center flex-nowrap">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->getRoleName() . '.home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="notification">

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <div class="toast ml-auto" role="alert" data-delay="4000">
                    <div class="toast-header">
                        <strong class="mr-auto text-{{ $msg }}">{{ $msg }}</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ Session::get('alert-' . $msg) }}
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <!--/.Flash Message -->

        <main>
            @yield('content')
        </main>
    </div>

    <footer>
        <a href="{{ url('/') }}">valentina bianchi</a>
    </footer>

@yield('script')

</body>
</html>

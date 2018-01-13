<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Landoretti Art</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('storage/images/landoretti_logo.png') }}" class="logo">
                    </a>
                </div>

                <!-- top bit of navbar (profile, ...) -->
                <div class="collapse navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @guest
                        <li><a href="{{ route('register') }}">REGISTER</a></li>

                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <input class="login-checkbox" type="checkbox" name="remember" checked>
                            <div class="col-md-4 loginpadding">
                                <input id="email" placeholder="user" type="email" class="form-control input-sm" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-4 loginpadding">
                                <input id="password" placeholder="password" type="password" class="form-control input-sm" name="password" required>
                            </div>
                            <div class="col-md-1 loginpadding">
                                <button type="submit" class="btn-sm btn-primary">></button>
                            </div>
                        </form>

                        @else
                        <li><a href="{{ url('watchlist') }}">WATCHLIST</a></li>
                        <li><a href="#">PROFILE</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                LOGOUT
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <input class="form-control input-sm" placeholder="Search" id="searchinput" type="text">
                        </li>
                        <li><a href="#">SEARCH</a></li> <!-- future: magnifying glass -->
                    </ul>
                </div>

                <!-- bottom bit of navbar -->
                <div class="collapse navbar-collapse navbar-bot" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home') }}">HOME</a></li>
                        <li><a href="{{ url('auctions') }}">ART</a></li>
                        <li><a href="#">ISEARCH</a></li>
                        @if (Auth::check())
                        <li><a href="{{ route('myAuctions') }}">MYAUCTIONS</a></li>
                        <li><a href="#">MYBIDS</a></li>
                        @endif
                        <li><a href="#">CONTACT</a></li>
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Language Settings -->
                        <li><a href="#">NL</a></li>
                        <li><a href="#">FR</a></li>
                        <li><a href="#">EN</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row marginbelow">
                <div class="col-md-6">
                    @yield('breadcrumb')
                </div>
                <div class="col-md-6">
                    <span class="pull-right">@yield('pagination')</span>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

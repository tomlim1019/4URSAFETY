<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '4URSAFETY') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
    <style>
        .bg-light{
            background-color: #0C2340 !important;
            padding-top:20px;
            padding-left:30px;
            min-height: calc(100vh - 59px);
            opacity: 0.95;            
        }

        .container-fluid{
            width: 100%;
            padding-left: 0;
            padding-top:3px;
        }

        .sidebar a{
            color:white;
        }

        .sidebar a:hover{
            color: #1d68a7;
        }

        .btn-outline-primary{
            border-color: #0066ff;
            color: #0066ff	;
        }
        
        .btn-outline-primary:hover{
            background-color: #0066ff	;
            border-color: #0066ff	;
        }

        .btn-outline-secondary{
            border-color: #0C2340;
            color: #0C2340;
        }
        
        .btn-outline-secondary:hover{
            background-color: #0C2340;
            border-color: #0C2340;
        }

        .btn-outline-danger{
            border-color: #FF0000;
            color: #FF0000;
        }

        .btn-outline-danger:hover{
            background-color: #FF0000;
        }

        .btn-link:hover{
            text-decoration:none;
            color: white;
        }
        .myCard {
            width: 100%;
            height: auto;
            margin: 25px auto;
            padding: 12px 25px 25px 25px;
            background-color: white;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }   
        .text-big{
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', '4URSAFETY') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <b><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></b>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <b><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></b>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b>{{ Auth::user()->name }}</b> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('My Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <main>
            @auth
            <div class="container-fluid">
                <div class="row">
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar text-big">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @if(Auth::user()->role=='admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                            <span data-feather="file"></span>
                            Categories
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ Auth::user()->role=='customer' ? route('customer.product') : route('products.index') }}">
                            <span data-feather="file"></span>
                            Product
                            </a>
                        </li>
                        @if(Auth::user()->status == 'Approved')
                        @if(Auth::user()->role=='customer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.log') }}">
                            <span data-feather="file"></span>
                            My Product
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ Auth::user()->role=='customer' ? route('customer.request') : route('quotations.index') }}">
                            <span data-feather="shopping-cart"></span>
                            @if(Auth::user()->role=='admin')
                            Request
                            @else
                            My Request
                            @endif
                            </a>
                        </li>
                        @if(Auth::user()->role=='admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logs.index') }}">
                            <span data-feather="users"></span>
                            Purchase Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('staff.report') }}">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer') }}">
                            <span data-feather="layers"></span>
                            Customer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('staff') }}">
                            <span data-feather="home"></span>
                            Staff <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @endif
                        @endif
                        </ul>
                    </div>
                </nav>
            @endauth
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @elseif(session()->has('danger'))
                <div class="alert alert-danger">
                    {{ session()->get('danger') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                @yield('content')
            </main>
            </div>
        </div>
        </main>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>



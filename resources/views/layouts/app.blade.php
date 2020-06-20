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
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;450&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
    <style>
        .bg-light{
            background-color: rgb(42,63,84) !important;
            min-height: calc(100vh - 59px);
            opacity: 0.95;            
        }

        .container-fluid{
            width: 100%;
            padding-left: 0.9rem;
            padding-top:3px;
        }

        .sidebar a{
            color:white;
        }

        .sidebar a:hover{
            background-color: rgb(53,74,95);  
            color: white;                     
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
            border-color: rgb(53,74,95);
            color: rgb(53,74,95);
        }
        
        .btn-outline-secondary:hover{
            background-color: rgb(53,74,95);
            border-color: rgb(53,74,95);
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
            margin: 1.5rem auto;
            padding: 12px 25px 25px 25px;
            background-color: white;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }   

        .text-big{
            font-size: 1.1rem;
        }

        .sidebar{
            padding: 0;
        }

        .nav-link{
            font-family:'Raleway', sans-serif;
            padding-left: 2rem;
            padding-top: 0.4rem;
        }

        .title{
            padding:0.55rem 0.1rem 0.1rem 0.1rem;
            color: #589ABF;
            opacity:0.9;
            margin-left: 1rem;
        }

        .myCard5{
            padding: 2rem 1rem 1rem 1rem;
            margin: 1.2rem 1rem 0.2rem 1rem;
            border: 1px solid lightgray;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #0D3152;
            color: white;
            height:2rem;
        }

        .footer_content{
            padding-top: 0.4rem;
            text-align: center;
        }

        .active{
            background-color: RGB(53, 74, 95);
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
                    <nav id="sidebarMenu" class="bg-light sidebar text-big col-md-2">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @if(Auth::user()->role=='admin' || Auth::user()->role=='staff')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <span data-feather="file"></span>
                            Categories
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('products*') || request()->routeIs('customer.product')) ? 'active' : '' }}" href="{{ Auth::user()->role=='customer' ? route('customer.product') : route('products.index') }}">
                            <span data-feather="file"></span>
                            Product
                            </a>
                        </li>
                        @if(Auth::user()->status == 'Approved')
                        @if(Auth::user()->role=='customer')
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('logs*') || request()->routeIs('customer.log'))  ? 'active' : '' }}" href="{{ route('customer.log') }}">
                            <span data-feather="file"></span>
                            My Product
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('quotations*') || request()->routeIs('customer.request')) ? 'active' : '' }}" href="{{ Auth::user()->role=='customer' ? route('customer.request') : route('quotations.index') }}">
                            <span data-feather="shopping-cart"></span>
                            @if(Auth::user()->role=='admin' || Auth::user()->role=='staff')
                            Request
                            @else
                            My Request
                            @endif
                            </a>
                        </li>
                        @if(Auth::user()->role=='admin' || Auth::user()->role=='staff')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('logs*') ? 'active' : '' }}" href="{{ route('logs.index') }}">
                            <span data-feather="users"></span>
                            Purchase Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('staff.report*') ? 'active' : '' }}" href="{{ route('staff.report') }}">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                            </a>
                        </li>
                        @if(Auth::user()->role=='admin')
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('customer') || request()->routeIs('customer.edit')) ? 'active' : '' }}" href="{{ route('customer') }}">
                            <span data-feather="layers"></span>
                            Customer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('staff') ? 'active' : '' }}" href="{{ route('staff') }}">
                            <span data-feather="home"></span>
                            Staff <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @endif
                        @endif
                        @endif
                        </ul>
                    </div>
                </nav>
            @endauth
            @yield('login')
            <main role="main" class="col-md-10 mx-sm-auto">
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

    <footer class="footer">
        <div class="footer_content">           
            <p style = "font-size:12px"><span style = "margin-right:0.5rem;">Email :</span>admin@test.com <span style ="margin-left: 4rem;"><span style = "margin-right:0.5rem;">Contact :</span>013-3834188 </span></p>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>



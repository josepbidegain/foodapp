<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="/admin/profile/{{ Auth::user()->id }}">
                                        Edit
                                    </a>

                                   
                                </li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>

                

            </div>
        </nav>

        
    </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">

                      <li class="menu-item">
                        <a href="/admin/clients" class="clients menu-item list-group-item">
                            <i class="fa fa-list-alt fa-fw"></i>
                            Clients
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="/admin/restaurants" class="restaurants menu-item list-group-item">
                            Restaurants
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="/admin/products" class="products menu-item list-group-item">   Products
                        </a>
                      </li>
                      <li>
                        <a href="/admin/discounts" class="discounts menu-item list-group-item">
                        Discounts
                        </a>
                      </li>
                      <li>
                        <a href="/admin/promotions" class="promotions menu-item list-group-item">
                            Promotions
                        </a>
                      </li>
                      <li>
                        <a href="/admin/orders" class="orders menu-item list-group-item">       Orders
                        </a>
                      </li>
                    <li>
                        <a href="/admin/history" class="history menu-item list-group-item">       History
                        </a>
                      </li>

                    </ul>
                </div>
                <div class="col-md-9 well">
                    @yield('content')
                </div>
            </div>
        </div>

    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin/client.js') }}"></script>
</body>
</html>

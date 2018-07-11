{{-- <nav class="navbar navbar-default navbar-static-top">
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
            <a class="navbar-brand text-uppercase" href="{{ url('/') }}">
                {{ config('app.name', 'Secondhand shop') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('welcome') }}">Home</a></li>
                <!-- Authentication Links -->

                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="">Help</a></li>
                @else
                    <li><a href="">Help</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->full_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
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
                @endif
                
            </ul>
        </div>
    </div>
</nav> --}}

<div class="header">
    <div class="header-top header-top-small">
        <div class="container">
             <div class="top-left">
                <a href="#"> Help  <i class="fa fa-phone fa-5x"></i> +977 985-1234047</a>
            </div>
            <div class="top-right">
            <ul>
                {{-- <li><a href="checkout.html">Checkout</a></li> --}}
                @if(auth()->check())
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ffffff">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        @if(authUser()->is_admin)
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('users.dashboard') }}">Dashboard</a>
                        @endif
                    </li>

                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}"> Create Account </a></li>
                @endif
            </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="heder-bottom header-bottom-small">
        <div class="container">
            <div class="logo-nav">
                <div class="logo-nav-left">
                    <h1>
                        <a href="{{ route('welcome') }}" style="font-size: 20px!important" class="hidden-xs">SECONDHAND SHOP 
                            <span style="letter-spacing: 1px; font-size: 10px; padding-top: 10px">
                                YOU SELL WE BUY
                                YOU BUY WE SELL
                            </span>
                        </a>
                    </h1>
                    <h1>
                        <a href="{{ route('welcome') }}" style="font-size: 10px!important; letter-spacing: 2px" class="hidden-lg hidden-md hidden-sm">
                            YOU SELL WE BUY 
                            <span style="letter-spacing: 2px; font-size: 10px; padding-top: 4px">
                            YOU BUY WE SELL
                            </span>
                        </a>
                    </h1>
                </div>
                <div class="logo-nav-left1">
                    <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header nav_2">
                        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> 
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav">
                            <li class="{{ setActive('welcome') }}"><a href="{{ route('welcome') }}" class="act">Home</a></li>   
                            
                            <li class="{{ set_active('home_furniture') }}"><a href="{{ route('general.category', 'home_furniture') }}">Home furniture</a>
                            </li>
                            <li class="{{ set_active('office_furniture') }}"><a href="{{ route('general.category', 'office_furniture') }}">Office furniture</a>
                                
                            </li>
                            <li class="{{ set_active('electronics') }}"><a href="{{ route('general.category', 'electronics') }}">Electronics</a>
                                
                            </li>
                            <li class="{{ set_active('others') }}">
                                <a href="{{ route('general.category', 'others') }}">Others</a>
                            </li>
                        </ul>
                    </div>
                    </nav>
                </div>
                <div class="logo-nav-right">
                    <ul class="cd-header-buttons cd-header-buttons-small">
                        <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
                    </ul> <!-- cd-header-buttons -->
                    <div id="cd-search" class="cd-search">
                        <form action="#" method="post">
                            <input name="Search" type="search" placeholder="Search...">
                        </form>
                    </div>  
                </div>
               {{--  <div class="header-right2">
                    <div class="cart box_1">
                        <a href="checkout.html">
                            <h3> <div class="total">
                                <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                                <img src="images/bag.png" alt="" />
                            </h3>
                        </a>
                        <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                        <div class="clearfix"> </div>
                    </div>  
                </div> --}}
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
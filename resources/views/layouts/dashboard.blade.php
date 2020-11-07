<!DOCTYPE html>
<html>
<head>
    <title>Laundry System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{asset('css/cart.css')}}" rel="stylesheet">
    <link href="{{asset('css/point.css')}}" rel="stylesheet">
</head>
<body>
    <nav class="navbar  navbar-inverse  navbar-fixed-top">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                <span class="sr-only"> Toggle navigation</span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
            </button>
            <a class="navbar-brand" style="font-size:25px;color:white;" href="{{ url('home') }}">Laundry System</a>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left">
                    @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Point<b class="caret"> </b>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('points/create') }}" class="dropdown-item whov">Create</a></li>
                                <li><a href="{{ url('points') }}" class="dropdown-item">View</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Items<b class="caret"> </b>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('items/create')}}" class="dropdown-item whov">Create</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">View All User<b class="caret"> </b>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item whov" href="{{ url('users') }}">All User</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item " href="{{ url('adminorderdetails') }}">Order History</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item " href="{{ url('orderlist') }}">Order List</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item whov" href="{{ url('washlist') }}">Wash List</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item whov" href="{{ url('deliverlist') }}">Deliver List</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="{{url('adduser')}}" class="nav-link" >Add User</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a href="{{ url('aboutus') }}" class="nav-link"> About Us </a>
                                </li>
                                @endif
                                @endif
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                @guest
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @else
                                @if(!Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="cursor: none; color:white;">Points : {{Auth::user()->point_amount}}</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{url('points')}}" class="nav-link" >Point Package</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('orderhistory')}}" class="nav-link" >Order History</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('basketLists')}}" class="nav-link" >Basket List</a>
                                </li>
                                @endif
                                <li class="dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->name }} <b class="caret"> </b>
                                        <ul class="dropdown-menu">
                                            <li><a class="nav-link"  href="{{ url('namechange') }}" ><i class="fa fa-edit"></i> Change Name</a> </li>
                                            <li><a class="nav-link" href="{{ url('passwordchange') }}"><i class="fa fa-edit"></i> Change Password</a> </li>
                                            <li><a class="nav-link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form> 
                                        </li>
                                    </ul>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    @yield('content')
                </div>
                <div class="navbar  navbar-inverse navbar-fixed-bottom"> 
                    <div class="container">
                        <p class="footer text-center">&copy;
                            @if(date('Y') >2017)
                            2017 - 2018 Meikhtila internship
                            @else 
                            2017
                        @endif </p>
                    </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                @yield('scripts')
            </body>
            </html>
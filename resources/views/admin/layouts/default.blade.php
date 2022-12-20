<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="icon" href="{{ asset('assets/images/issb-logo.png') }}" type="image/png" sizes="16x16"> -->
    <title>
        @section('title')
        | ISSB
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- global css -->
    <link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}" crossorigin="anonymous">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bootstrap-3.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sweetalert/sweet-alert.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <!-- font Awesome -->
    {{-- <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" crossorigin="anonymous"> --}}

    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->

    <style>
        .footer {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 5px;
        }

        .right-side {
            padding-bottom: 25px !important;
        }
    </style>

<body class="skin-josh">
    <header class="header">
        <a href="{{ URL::to('/') }}" class="logo">
            <img src="{{ asset('assets/images/issb-logo.png') }}" height="50" width="50" alt="logo" style="border-radius: 50%;">
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    @include('admin.layouts._messages')
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets/images/issb-logo.png') }}" alt="img" height="35px" width="35px" class="img-circle img-responsive pull-left" />
                            <div class="riot">
                                <div>
                                    <p class="user_name_max">{{ Auth::user()->name }}</p>
                                    <span><i class="caret"></i></span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="{{ asset('assets/images/issb-logo.png') }}" alt="img" height="35px" width="35px" class="img-circle img-responsive pull-left" />
                                <p class="topprofiletext">ISSB</p>
                            </li>
                            <!-- User image -->

                            <!-- Menu Body -->
                            @if(Auth::user()->hasRole('conductingOfficer'))
                            <li class="user-body">
                                <a href="{{ route('stdSeatPlan') }}">
                                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                                    <span class="title">Seat Plan</span>
                                </a>
                            </li>

                            <li class="user-body">
                                <a href="{{ route('examScheduleList') }}">
                                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                                    <span class="title">Assessment Schedules</span>
                                </a>
                            </li>
                            @endif
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="text-center">
                                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
                                        <i class="livicon" data-name="sign-out" data-s="15"></i>
                                        Logout
                                    </a>
                                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wr-content">
        <div class="wrapper ">
            <!-- Left side column. contains the logo and sidebar -->
            @if(!(Auth::user()->hasRole('conductingOfficer')))
            <aside class="left-side ">
                <section class="sidebar ">
                    <div class="page-sidebar  sidebar-nav">
                        <div class="clearfix"></div>
                        <!-- BEGIN SIDEBAR MENU -->

                        @include('admin.layouts._left_menu',compact('testLists'))
                        <!-- END SIDEBAR MENU -->
                    </div>
                </section>
            </aside>
            @endif
            <aside class="right-side">

                <!-- Notifications -->


                <!-- Content -->
                @yield('content')

                {{--<div class="footer">
                <p>Powered by <a href="#">Silver Eagle</a></p>
            </div>--}}
            </aside>
            <!-- /* right-side -->
            {{--<footer class="footer">--}}
                {{--<strong>Powered by dd <a href="https://silvereagle.com.bd" target="_blank">Silvereagle</a>.</strong>--}}
                {{--<div class="hidden-xs">--}}
                {{--</div>--}}
            {{--</footer>--}}
        </div>
    </div>



    <!-- global js -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/fontawesome.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('sweetalert/sweet-alert.js')}}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('bootstrap-3.4.1-dist/js/bootstrap.min.js') }}"></script> --}}
    <!-- end of global js -->
    <!-- begin page level js -->
    @yield('footer_scripts')

</body>

</html>

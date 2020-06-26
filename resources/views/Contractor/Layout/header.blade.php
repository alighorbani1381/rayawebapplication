<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="/admin/images/favicon.ico">

    <title>@yield('title')</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/morris/morris.css') }}">

    <!-- App css -->
    <link href="{{ asset('admin/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- Pretty CheckBox !-->
    <link href="{{ asset('admin/css/checkbox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/css/developer.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/modernizr.min.js') }} "></script>
    <script src="{{ asset('admin/js/sweetalert.js') }} "></script>
    <script src="{{ asset('admin/js/customJS/developer.js') }} "></script>
    @stack('css')
    @stack('js')

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ route('contractor.dashbord') }}" class="logo">
                    <span>پنل کاربری<span> شما</span></span>
                    <i class="zmdi zmdi-layers"></i></a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">

                    <!-- Page title -->
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <button class="button-menu-mobile open-left">
                                <i class="zmdi zmdi-menu"></i>
                            </button>
                        </li>
                        <li>
                            <h4 class="page-title">@yield('header')</h4>
                        </li>
                    </ul>

                    <!-- Right(Notification and Searchbox -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <!-- Notification -->
                            <div class="notification-box">
                                <ul class="list-inline m-b-0">
                                    <li>
                                        <a href="javascript:void(0);" class="right-bar-toggle">
                                            <i class="zmdi zmdi-notifications-none"></i>
                                        </a>
                                        <div class="noti-dot">
                                            <span class="dot"></span>
                                            <span class="pulse"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Notification bar -->
                        </li>
                        <li class="hidden-xs">
                            <form role="search" class="app-search">
                                <input type="text" placeholder="به دنبال چه می گردی ؟؟؟" class="form-control">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->
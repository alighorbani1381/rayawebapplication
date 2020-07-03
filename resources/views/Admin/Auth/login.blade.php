<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="/admin/images/rayapro.ico">

    <!-- App title -->
    <title>ورود</title>

    <!-- App CSS -->
    <link href="/admin/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/core.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/components.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/developer.css') }}" rel="stylesheet" type="text/css" />
    <script src="/admin/js/modernizr.min.js"></script>
    <script src="/admin/js/jquery.min.js"></script>
    <script src="{{ asset('admin/js/sweetalert.js') }} "></script>
    <script src="{{ asset('admin/js/customJS/developer.js') }} "></script>
    <script>
        $(window).load(function(){
            setTimeout(function(){
                $('.preloader').fadeOut('slow');  
            }, 1000);
        });
    </script>
</head>

<body>
    <div class="preloader"></div>

    @php $num = rand(1,5); @endphp
    <style>
        .account-pages {
            background: url("/admin/images/background/background{{ $num }}.jpg") center;
            background-size: cover;
        }
    </style>
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="text-center">
            <a href="{{ route('login.show') }}">
                <img class="login-logo"
                    src="/admin/images/logo/rayapro-@if($num == 3 || $num == 4){{"light"}}@else{{"dark"}}@endif.png"
                    alt="RayaPro">
            </a>
        </div>

        <div class="m-t-40 card-box" style="box-shadow: 1px 1px 14px 0px #949494;">

            <div class="text-center welcome-login">
                <a href="{{ route('login.show') }}" class="logo"><span>Raya User<span>Panel</span></span></a>
                <h5 style="margin:10px 0;" class="text-muted m-t-0 font-600">
                    پنل کاربری شرکت رایا پردازش اصفهان
                </h5>
            </div>

            <div class="text-center" style="margin-top: 35px;">
                <h4 class="text-uppercase font-bold m-b-0">همین الان وارد شوید !</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal m-t-20" method="post" action="{{ route('login.check') }}">
                    @csrf

                    @if(session()->has('LoginFail'))
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="alert alert-danger">
                                <i class="fa fa-warning"></i>
                                نام کاربری یا رمزعبور شما صحیح نمی باشد.
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required=""
                                placeholder="نام کاربری">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required=""
                                placeholder="رمزعبور">
                        </div>
                    </div>


                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light"
                                type="submit">ورود</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <!-- end card-box-->

    </div>
    <!-- end wrapper page -->



    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="/admin/js/bootstrap-rtl.min.js"></script>
    <script src="/admin/js/detect.js"></script>
    <script src="/admin/js/fastclick.js"></script>
    <script src="/admin/js/jquery.slimscroll.js"></script>
    <script src="/admin/js/jquery.blockUI.js"></script>
    <script src="/admin/js/waves.js"></script>
    <script src="/admin/js/wow.min.js"></script>
    <script src="/admin/js/jquery.nicescroll.js"></script>
    <script src="/admin/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="/admin/js/jquery.core.js"></script>
    <script src="/admin/js/jquery.app.js"></script>

    @if(session()->has('logoutSuccess'))
    <script>
        var message = "با موفقیت از سیستم خارج شدید";
        minMbox(message, 200);
    </script>
    @endif
</body>

</html>
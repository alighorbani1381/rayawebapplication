@extends('Admin.Layout.main')
@section('title', 'رایا مدیر')
@section('header', 'پنل مدیریتی رایا مدیر')
@section('content')

<!-- Global Statistic Start !-->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-custom" data-plugin="counterup">{{ $globalStatistic['projects'] }}</h2>
                <h5>تعداد کل پروژه ها</h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-pink" data-plugin="counterup">{{ $globalStatistic['active_projects'] }}</h2>
                <h5>تعداد پروژه های در دست انجام</h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-warning" data-plugin="counterup">{{ $globalStatistic['users'] }}</h2>
                <h5>تعداد کاربران شما</h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-info" data-plugin="counterup">{{ $globalStatistic['categories'] }}</h2>
                <h5>تعداد خدمات شما</h5>
            </div>
        </div>
    </div>
</div>
<!-- Global Statistic End !-->


<!-- Project Container Start !-->
<div class="row">

    <!-- Project Widget Start !-->
    <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('projects.index') }}">لیست پروژه ها</a></li>
                    <li><a href="{{ route('projects.create') }}">افزودن پروژه جدید</a></li>
                </ul>
            </div>
            <h4 class="header-title m-t-0 m-b-30">
                وضعیت پیشرفت پروژه های در دست انجام
            </h4>

            @if(count($projectStatistic['project']) != 0 )
            @foreach($projectStatistic['project'] as $key => $project)
            <?php
            $progress = $projectStatistic['progress'][$key]; 
            if($progress < 25) $color="danger"; 
            if($progress>= 25 && $progress < 50) $color="warning";                            
            if($progress>= 50 && $progress < 75) $color="info";
            if($progress>= 75 && $progress <= 100) $color="success"; 
            ?>
            <!-- Project Item Start !-->
            <p class="font-600 m-b-5">
                {{ $project->title}}
                <span class="text-{{$color}} pull-right">{{ $progress }}%</span>
            </p>
            <div class="progress progress-bar-primary-alt progress-sm m-b-20">
                <div class="progress-bar progress-bar-{{$color}} progress-animated wow animated animated"
                    role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"
                    style="width: {{ $progress }}%; visibility: visible; animation-name: animationProgress;">
                </div>
            </div>
            <!-- Project Item End !-->
            @endforeach



        </div>
    </div>
    @else
    <div class="alert-alert info">
        <i class="fa fa-info-cirlce"></i> &nbsp;
        پروژه فعالی در سیستم وجود ندارد.
    </div>
    <!-- Project Widget End !-->
    @endif

    <!-- Last Project  Widget Start !-->
    <div class="col-lg-8">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">فعال</a></li>
                    <li><a href="#">متن اول</a></li>
                    <li><a href="#">متن دوم</a></li>
                    <li class="divider"></li>
                    <li><a href="#">متن پاورقی</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">آخرین پروژه های اجرا شده</h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام پروژه</th>
                        <th>تاریخ شروع</th>
                        <th>سررسید</th>
                        <th>وضعیت</th>
                        <th>نوع</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>آقای ادمین</td>
                            <td>01/01/2016</td>
                            <td>26/04/2016</td>
                            <td><span class="label label-danger">به اتمام رسید</span></td>
                            <td>قالب HTML</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>املاک نیاوران</td>
                            <td>01/01/2016</td>
                            <td>26/04/2016</td>
                            <td><span class="label label-success">در حال برسی</span></td>
                            <td>قالب وردپرس</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>اپ شرط بندی</td>
                            <td>01/05/2016</td>
                            <td>10/05/2016</td>
                            <td><span class="label label-pink">اجرا شده</span></td>
                            <td>اندروید</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>اپ شرط بندی</td>
                            <td>01/01/2016</td>
                            <td>31/05/2016</td>
                            <td><span class="label label-purple">تست نهایی</span>
                            </td>
                            <td>آی او اس</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>چت روم ایرانی</td>
                            <td>01/01/2016</td>
                            <td>31/05/2016</td>
                            <td><span class="label label-warning">به زودی</span></td>
                            <td>لاراول</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>حساب یار</td>
                            <td>01/01/2016</td>
                            <td>31/05/2016</td>
                            <td><span class="label label-primary">به زودی</span></td>
                            <td>برنامه ویندوزی</td>
                        </tr>

                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Last Project  Widget End !-->
</div>
<!-- Project Container End !-->



<!-- Admins Container Start !-->
<div class="row">

    @foreach($adminsStatistic as $admin)
    <!-- Admin Box Start !-->
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div>
                <img src="{{ $admin->profile_image }}" class="img-responsive img-circle" alt="user">
                <div class="wid-u-info">
                    <h4 class="m-t-0 m-b-5">{{ $admin->full_name }}</h4>
                    <p class="text-muted m-b-5 font-13">
                        <a href="#">
                            {{ $admin->phone }}
                        </a>
                    </p>


                    <small class="text-warning"><b>مدیر</b></small>
                </div>
            </div>
        </div>
    </div>
    <!-- Admin Box End !-->
    @endforeach
</div>
<!-- Admins Container End !-->


@endsection
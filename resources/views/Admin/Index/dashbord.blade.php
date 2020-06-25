@extends('Admin.Layout.main')
@section('title', 'رایا مدیر')
@section('header', 'پنل مدیریتی رایا مدیر')
@section('content')
<div class="row">

    <div class="col-lg-3 col-md-6">
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
            <h4 class="header-title m-t-0 m-b-30">پروژه ها</h4>

            <p class="font-600 m-b-5">سایت املاک <span class="text-primary pull-right">80%</span></p>
            <div class="progress progress-bar-primary-alt progress-sm m-b-20">
                <div class="progress-bar progress-bar-primary progress-animated wow animated animated"
                    role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                    style="width: 80%; visibility: visible; animation-name: animationProgress;">
                </div>
            </div>



        </div>
    </div>

</div>

@endsection
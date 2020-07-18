@extends('Contractor.Layout.main')
@section('title', 'پنل کاربری')
@section('header', 'پنل کاربری شما')
@section('content')

<?php 
$allProjects = $projects['ongoing']->count() + $projects['finished']->count() +$projects['waiting']->count();
$activeProjects = $projects['ongoing'];
?>

<!-- Global Statistic Start !-->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-purple" data-plugin="counterup">{{ $allProjects . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-laptop i-fix"></i>
                    <span>تعداد کل پروژه های شما</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-warning" data-plugin="counterup">{{ $activeProjects->count() . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-gear i-fix"></i>
                    <span>تعداد پروژه های در دست انجام</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-primary" data-plugin="counterup">{{ number_format($earnings['sum']) . " تومان " }}</h2>
                <h5>
                    <i class="fa fa-money i-fix"></i>
                    <span>مجموع درآمد شما</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-danger" data-plugin="counterup">{{ number_format($credits['sum']) . " تومان " }}</h2>
                <h5>
                    <i class="fa fa-dollar i-fix"></i>
                    <span>میزان بستانکاری شما</span>
                </h5>
            </div>
        </div>
    </div>
</div>
<!-- Global Statistic End !-->



<!-- Project Container Start !-->
<div class="row">

    @if(hasMember($activeProjects))
    <!-- Project Widget Start !-->
    <div class="col-lg-4 col-md-6">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('contractor.projects.ongoing') }}">لیست پروژه ها</a></li>
                </ul>
            </div>
            <h4 class="header-title m-t-0 m-b-30">
                <i class="fa fa-history i-fix"></i>
                <span>
                    وضعیت پیشرفت پروژه های در دست انجام
                </span>
            </h4>


            @foreach($activeProjects as $key => $project)
            <?php
            $progress = $project->progress; 
            $color = getStatusColor($progress);
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
    <!-- Project Widget End !-->
    @endif

    <!-- Last Project  Widget Start !-->
    <div class="@if(hasMember($activeProjects)){{"col-lg-8"}}@else{{"col-lg-12"}}@endif">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('contractor.projects.ongoing') }}">
                            لیست پروژه ها
                        </a>
                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                <i class="fa fa-diamond i-fix"></i>
                <span>آخرین پروژه های در دست انجام</span>
            </h4>

            @if(hasMember($activeProjects))
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="tac">ردیف</th>
                            <th class="tac">نام پروژه</th>
                            <th class="tac">شناسه پروژه</th>
                            <th class="tac">تاریخ شروع کار</th>
                            <th class="tac">تاریخ تحویل</th>
                            <th class="tac">زمان تحویل</th>
                            <th class="tac">مشاهده</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($activeProjects as $row => $project)
                        <?php
                        $projectStartAt = verta($project->date_start);
                        $delivery = $projectStartAt->addDays($project->complete_after);
                        ?>
                        <tr>
                            <td class="tac">{{ $row + 1}}</td>
                            <td class="tac">{{ $project->title }}</td>
                            <td class="tac">{{ $project->unique_id }}</td>
                            <td class="tac date-show">{{ $projectStartAt->formatJalaliDate() }}</td>
                            <td class="tac date-show">{{ $delivery->formatJalaliDate() }}</td>
                            <td class="tac">{{ $delivery->formatDifference() }}</td>
                            <td class="tac">
                                <a href="{{ route('contractor.projects.show', $project->id) }}"
                                    class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            @else
            <img class="exists-record" src="{{ asset('admin/images/symbols/Notproject.png') }}" alt="پروژه ای یافت نشد">
            <div class="notfound-content">
                <span style="font-size: x-large;">
                    تا کنون برای شما پروژه ای ثبت نشده است.
                </span>
            </div>
            @endif

        </div>
    </div>
    <!-- Last Project  Widget End !-->


</div>
<!-- Project Container End !-->



@if(session()->has('profile-changed'))
<script>
    var message = "پروفایل شما با موفقیت تغییر کرد.";
    minMbox(message, 250);
</script>
@endif
@endsection
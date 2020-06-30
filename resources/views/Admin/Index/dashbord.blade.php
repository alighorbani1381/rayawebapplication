@extends('Admin.Layout.main')
@section('title', 'رایا مدیر')
@section('header', 'پنل مدیریتی رایا مدیر')
@section('content')

<!-- Global Statistic Start !-->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-custom" data-plugin="counterup">{{ $globalStatistic['projects'] . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-laptop"></i>
                    <span>تعداد کل پروژه ها</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-pink" data-plugin="counterup">{{ $globalStatistic['active_projects'] . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-gear"></i>
                    <span>تعداد پروژه های در دست انجام</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-warning" data-plugin="counterup">{{ $globalStatistic['users'] . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-users"></i>
                    <span>تعداد کاربران شما</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-info" data-plugin="counterup">{{ $globalStatistic['categories'] . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-support"></i>
                    <span>تعداد خدمات شما</span>
                </h5>
            </div>
        </div>
    </div>
</div>
<!-- Global Statistic End !-->


<!-- Project Container Start !-->
<div class="row">

    <!-- Project Widget Start !-->
    <div class="col-lg-4 col-md-6">
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
                    <li><a href="{{ route('projects.index') }}">لیست پروژه ها</a></li>
                    <li><a href="{{ route('projects.create') }}">افزودن پروژه جدید</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">آخرین پروژه های اجرا شده</h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="tac">#</th>
                            <th class="tac">نام پروژه</th>
                            <th class="tac">شناسه پروژه</th>
                            <th class="tac">تاریخ شروع قرارداد</th>
                            <th class="tac">تاریخ شروع کار</th>
                            <th class="tac">وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($latestProject as $row => $project)
                        <tr>
                            <td class="tac">{{ $row + 1}}</td>
                            <td class="tac">{{ $project->title }}</td>
                            <td class="tac">{{ $project->unique_id }}</td>
                            <td class="tac date-show">{{ verta($project->contract_started)->format('Y/n/j') }}</td>
                            <td class="tac date-show">{{ verta($project->date_start)->format('Y/n/j') }}</td>
                            <td class="tac">
                                @php
                                if($project->status == 'waiting'){
                                $status['color'] = "danger";
                                $status['text'] = "غیر فعال";
                                }

                                if($project->status == 'ongoing'){
                                $status['color'] = "warning";
                                $status['text'] = "در حال اجرا";
                                }

                                if($project->status == 'finished'){
                                $status['color'] = "success";
                                $status['text'] = "پایان یافته";
                                }

                                @endphp

                                <span class="label label-{{$status['color']}}">{{ $status['text'] }}</span>
                            </td>
                        </tr>
                        @endforeach

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
                @if($admin->profile != 'default')
                <img src="{{ showPicture('admin.profile', $admin->profile) }}" class="img-responsive img-circle"
                    alt="user">
                @else
                <img src="{{ $admin->profile_image }}" class="img-responsive img-circle" alt="user">
                @endif
                <div class="wid-u-info">
                    <h4 class="m-t-0 m-b-5">
                        @if($admin->id == auth()->user()->id)
                        {{ "شما" }}
                        @else
                        {{ $admin->full_name }}
                        @endif
                    </h4>
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


@if(session()->has('profile-changed'))
<script>
    var message = "پروفایل شما با موفقیت تغییر کرد";
    minMbox(message, 250);
</script>
@endif

@endsection
@extends('Admin.Layout.main')
@section('title', 'رایا مدیر')
@section('header', 'پنل مدیریتی رایا مدیر')
@section('content')
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
            <h4 class="header-title m-t-0 m-b-30">پروژه ها</h4>
            
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
</div>

@endsection
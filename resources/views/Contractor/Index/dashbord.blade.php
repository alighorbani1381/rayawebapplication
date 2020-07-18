@extends('Contractor.Layout.main')
@section('title', 'پنل کاربری')
@section('header', 'پنل کاربری شما')
@section('content')

<?php 
$allProjects = $projects['ongoing']->count() + $projects['finished']->count() +$projects['waiting']->count();
$test ="";?>

<!-- Global Statistic Start !-->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-purple" data-plugin="counterup">{{ $allProjects . " عدد " }}</h2>
                <h5>
                    <i class="fa fa-laptop"></i>
                    <span>تعداد کل پروژه های شما</span>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
            <div class="text-center">
                <h2 class="text-warning" data-plugin="counterup">{{ $projects['ongoing']->count() . " عدد " }}</h2>
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
                <h2 class="text-primary" data-plugin="counterup">{{ number_format($earnings['sum']) . " تومان " }}</h2>
                <h5>
                    <i class="fa fa-money"></i>
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
                    <i class="fa fa-dollar"></i>
                    <span>میزان بستانکاری شما</span>
                </h5>
            </div>
        </div>
    </div>
</div>
<!-- Global Statistic End !-->

@if(session()->has('profile-changed'))
<script>
    var message = "پروفایل شما با موفقیت تغییر کرد.";
    minMbox(message, 250);
</script>
@endif
@endsection
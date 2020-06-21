@extends('Admin.Layout.main')
@section('title', 'مشاهده جزئیات در آمد ها')
@section('header', 'مشاهده جزئیات')
@push('js')
<script src="{{ asset('admin/js/customJS/earnings.js') }} "></script>
@endpush
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">

                    <li>
                        <a href="{{ route('earnings.edit', $earning->id) }}"><i class="fa fa-pencil"></i>&nbsp;ویرایش این درآمد</a>
                    </li>

                    <li>
                        <a href="{{ route('earnings.index') }}"><i class="fa fa-repeat"></i>&nbsp;بازگشت به در آمد ها</a>
                    </li>
                </ul>
            </div>
            <div class="media m-b-20">
                <div class="media-left">
                    <a href="#"> <img class="media-object img-circle" alt="درآمد" src="/admin/images/users/avatar-1.jpg"
                            style="width: 48px; height: 48px;"> </a>
                </div>
                <div class="media-body" style="border-bottom: 2px solid #337ab7; padding-bottom: 13px;">


                    <h4 class="media-heading m-b-0 ear-sta-text">وضعیت این درآمد</h4>
                    @if($earning->status == 'paid')
                    <span class="label label-success earning-status-label">پرداخت شده</span>
                    @else
                    <span class="label label-danger earning-status-label">پرداخت نشده</span>
                    @endif
                </div>
            </div>

            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                عنوان:
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $earning->title }}</h4>
            <div class="clear-fix"></div>

            @php
            $paragraphs = explode('\n', $earning->description);
            @endphp
            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                توضیحات:
            </h4>
            @foreach ($paragraphs as $paragraph)
            <p class="text-muted">
                {{ $paragraph }}
            </p>
            @endforeach



            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>
                    <h5 class="font-600 m-b-5">تاریخ ثبت پروژه</h5>
                    <p class="date-show">{{ $earning->project_start }}</p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">تاریخ ثبت درآمد</h5>
                    <p class="date-show">{{ $earning->created_at }}</p>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div><!-- end col -->

    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('projects.show', $earning->project_id) }}">برو به این پروژه</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">اطلاعات پروژه</h4>

            <div>
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="عنوان پروژه"
                                src="/admin/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">عنوان پروژه</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $earning->project_title}}
                        </p>
                    </div>
                </div>

                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="شناسه پروژه"
                                src="/admin/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">شاناسه پروژه</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $earning->unique_id}}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- end col -->
</div>
@endsection
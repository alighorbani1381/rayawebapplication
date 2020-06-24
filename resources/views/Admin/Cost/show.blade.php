@extends('Admin.Layout.main')
@section('title', 'مشاهده جزئیات هزینه')
@section('header', 'مشاهده جزئیات')
@section('content')
@php
$costType = $cost['type'];
$cost = $cost['content'];
@endphp
<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">

                    <li>
                        <a href="{{ route('costs.edit', $cost->id) }}"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ویرایش</a>
                    </li>

                    <li>
                        <a href="{{ route('costs.index') }}"><i class="fa fa-repeat"></i>&nbsp;&nbsp;لیست هزینه ها</a>
                    </li>
                </ul>
            </div>
            <h4 class="header-title m-t-0 m-b-30">جزئیات هزینه</h4>
            <div class="media m-b-20">
                <div class="media-left">
                    <a href="#"> <img class="media-object img-circle" alt="هزینه" src="/admin/images/symbols/rial.png"
                            style="width: 48px; height: 48px; border:1px solid #ddd; vertical-align:-3px;"> </a>
                </div>
                <div class="media-body" style="border-bottom: 2px solid #337ab7; padding-bottom: 13px;">


                    <h4 class="media-heading m-b-0 ear-sta-text">وضعیت</h4>
                    @if($cost->status == 'paid')
                    <span class="label label-success earning-status-label">پرداخت شده</span>
                    @else
                    <span class="label label-danger earning-status-label">پرداخت نشده</span>
                    @endif
                </div>
            </div>

            <div class="clear-fix"></div>
            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                نوع هزینه : 
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $cost->type_title }}</h4>
            <div class="clear-fix"></div>

            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                عنوان هزینه : 
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $cost->title }}</h4>

            <div class="clear-fix"></div>

           

            @php
            $paragraphs = explode('\n', $cost->description);
            @endphp
            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                توضیحات : 
            </h4>
            @foreach ($paragraphs as $paragraph)
            <p class="text-muted">
                {{ $paragraph }}
            </p>
            @endforeach



            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>
                    @php $time = verta($cost->updated_at); @endphp
                    <h5 class="font-600 m-b-5">آخرین بروزرسانی</h5>
                    <p class="date-show">{{ $time->format('Y/n/j H:i') }}</p>
                </li>

                <li>
                    @php $time = verta($cost->created_at); @endphp
                    <h5 class="font-600 m-b-5">تاریخ ثبت هزینه</h5>
                    <p class="date-show">{{ $time->format('Y/n/j H:i') }}</p>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div><!-- end col -->

    @if($costType == 'project_base' || $costType == 'contract_pay' )
    @php $project = \App\Project::where('id', $cost->project_id)->first(); @endphp
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('projects.show', $project->id) }}" target="_blank"> <i class="fa fa-eye"></i> &nbsp;&nbsp;
                            مشاهده</a>

                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">اطلاعات پروژه</h4>

            <div>
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="عنوان پروژه"
                                src="/admin/images/symbols/project.png"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">عنوان پروژه</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $project->title}}
                        </p>
                    </div>
                </div>

                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="شناسه پروژه"
                                src="/admin/images/symbols/fingerprint.png"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">شناسه پروژه</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $project->unique_id}}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- end col -->
    @endif

    @if($costType == 'contract_pay' ||  $costType =='contract_without_project' )
    @php $user = \App\User::where('id', $cost->contractor_id)->first(); @endphp
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('users.show', $user->id) }}" target="_blank"> <i class="fa fa-eye"></i> &nbsp;&nbsp;
                            مشاهده کاربر
                        </a>

                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">اطلاعات کاربر</h4>

            <div>
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="عنوان پروژه"
                                src="/admin/images/users/default.png"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">نام کاربر</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $user->name . " " . $user->lastname }}
                        </p>
                    </div>
                </div>

                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="شناسه پروژه"
                                src="/admin/images/symbols/fingerprint.png"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">شماره تماس کاربر</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $user->phone}}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- end col -->
    @endif

</div>

@if(session()->has('UpdateCost'))
<script>
   var message = "هزینه مورد نظر با موفقیت بروزرسانی شد.";
   minMbox(message, 250);
</script>
@endif
@endsection

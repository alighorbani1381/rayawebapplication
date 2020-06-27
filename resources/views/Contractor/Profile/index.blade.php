@extends('Contractor.Layout.main')
@section('title', 'پروفایل کاربری')
@section('header', 'مشخصات کاربری شما')
@section('content')
<div class="row">

    <!-- Profile Panel Start !-->
    <div class="col-md-8">
        <div class="card-box task-detail">
            <h4 class="header-title m-t-0 m-b-30">اطلاعات کاربری شما</h4>
            <div class="media m-b-20">
                <div class="media-left">
                    <a href="#"> <img class="media-object img-circle" alt="هزینه" src="{{ $user->profile_image }}"
                            style="width: 48px; height: 48px; border:1px solid #ddd; vertical-align:-3px;"> </a>
                </div>
                <div class="media-body" style="border-bottom: 2px solid #337ab7; padding-bottom: 13px;">


                    <h4 class="media-heading m-b-0 ear-sta-text">نام کاربری شما</h4>
                    <span class="label label-primary earning-status-label">{{ $user->username }}</span>
                </div>
            </div>

            <div class="clear-fix"></div>
            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                نام شما :
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->name }}</h4>
            <div class="clear-fix"></div>

            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                نام خانوادگی شما :
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->lastname }}</h4>

            <div class="clear-fix"></div>

            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                زمان ثبت نام شما در سیستم رایا :
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">
                {{ verta($user->created_at)->formatDifference() }}</h4>

            <div class="clear-fix"></div>
        </div>
    </div>
    <!-- Profile Panel End !-->


    {{-- <form method="post" action="{{ route('projects.divide') }}">
    @csrf
    <input type="hidden" name="project_id" value="{{ $project['project']->id }}">
    @foreach($project['contractors'] as $key => $contractor)
    <div class="media m-b-10">
        <div class="media-left">
            <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64"
                    src="/admin/images/users/avatar-1.jpg"> </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{ $contractor->name . " " . $contractor->lastname }}</h4>
            <p class="font-13 text-muted m-b-0">
                <input type="hidden" value="{{ $contractor->contract_id }}" name="access[{{ $key }}]">

            </p>
        </div>

    </div>
    @endforeach --}}

    <!-- Reset Password Panel Start!-->
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">تغییر رمز عبور</h4>
            <div>
                <form action="" method="post">
                    <div class="media m-b-10">
                        <div class="media-left">
                            <a href="#"> <img class="change-pass media-object img-circle thumb-sm" alt="عنوان پروژه"
                                    src="/admin/images/symbols/key.png"> </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">رمز عبور فعلی</h4>
                            <input class="form-control input-sm" placeholder="رمز عبور فعلی را وارد کنید ..."
                                type="password" name="old_password" value="">
                        </div>
                    </div>

                    <div class="media m-b-10">
                        <div class="media-left">
                            <a href="#"> <img class="change-pass media-object img-circle thumb-sm" alt="شناسه پروژه"
                                    src="/admin/images/symbols/fingerprint.png"> </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">رمز عبور جدید</h4>
                            <input class="form-control input-sm" placeholder="رمز عبور جدید را وارد کنید ..."
                                type="password" name="old_password" value="">
                        </div>
                    </div>

                    <div class="media m-b-10">
                        <div class="media-left">
                            <a href="#"> <img class="change-pass media-object img-circle thumb-sm" alt="شناسه پروژه"
                                    src="/admin/images/symbols/repassword.png"> </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">تکرار رمز عبور جدید</h4>
                            <input class="form-control input-sm" placeholder="تکرار رمز عبور جدید را وارد کنید ..."
                                type="password" name="old_password" value="">
                        </div>
                    </div>

                    <div class="media m-b-10">
                        <button type="button" id="change-password" class="btn btn-primary waves-effect submit-button">
                            تغییر رمز عبور
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Reset Password Panel End!-->
</div>
@endsection
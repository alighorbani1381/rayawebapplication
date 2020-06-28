@extends('Contractor.Layout.main')
@section('title', 'پروفایل کاربری')
@section('header', 'مشخصات کاربری شما')
@push('css')
<script src="{{ asset('user/js/profile.js') }}" type="text/javascript"></script>
@endpush
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

            @if($user->is_default_password)
            <div class="alert alert-danger">
                <i class="fa fa-warning"></i>
                رمز عبور شما به صورت پیشفرض روی 
                <span style="color:black; font-weight:bold;">raya-px724</span>
                قرار دارد برای حفاظت از اطلاعت خود در همین صفحه از قسمت تغییر رمز عبور ، اقدام به تغییر رمز عبور خود کنید.
            </div>
            @endif

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

    <!-- Reset Password Panel Start!-->
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">تغییر رمز عبور</h4>
            <div>
                <form action="{{ route('profile.change.password') }}" method="post">
                @csrf
                    <div class="media m-b-10">
                        <div class="media-left">
                            <a href="#"> <img class="change-pass media-object img-circle thumb-sm" alt="عنوان پروژه"
                                    src="/admin/images/symbols/key.png"> </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">رمز عبور فعلی</h4>
                            <input class="form-control input-sm" placeholder="رمز عبور فعلی را وارد کنید ..."
                                type="password" name="old_password">

                                @error('old_password')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror

                                @if(session()->has('currentWrong'))
                                <div class="alert alert-danger">
                                رمز عبور فعلی اشتباه است
                                </div>
                                @endif
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
                                type="password" name="new_password">
                                  @error('new_password')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                
                                @enderror
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
                                type="password" name="repeat_password">
                                      @error('repeat_password')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror
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

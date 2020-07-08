@extends('Admin.Layout.main')
@section('title', 'جزئیات کاربر')
@section('header', 'جزئیات کاربر')
@section('content')
<div class="row">
    <div class="@if(!$user->isAdmin()){{"col-md-8 col-md-offset-2"}}@else{{"col-md-5"}}@endif">
        <div class="card-box task-detail">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">

                    <li>
                        <a href="{{ route('users.edit', $user->id) }}"><i
                                class="fa fa-pencil"></i>&nbsp;&nbsp;ویرایش</a>
                    </li>

                    @if($user->type == 'admin')
                    <li>
                        <a href="{{ route('roles.user.create', $user->id) }}"><i class="fa fa-shield"></i>&nbsp;&nbsp;
                            مدیریت سطح دسترسی
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
            <h4 class="header-title m-t-0 m-b-30">
                <i class="i-fix fa fa-user"></i>
                جزئیات کاربر
                @if($user->type == 'contractor')
                (کارمند)
                @else
                (مدیر)
                @endif
            </h4>
            <div class="media m-b-20">

                @if($user->profile != 'default' && $user->type == 'contractor')
                <a href="{{ showPicture('user.profile', $user->profile) }}">
                    <img class="user-pic media-object img-circle" alt="{{ $user->name . " " . $user->lastname }}"
                        src="{{ showPicture('user.profile', $user->profile) }}">
                </a>
                @endif

                @if($user->profile != 'default' && $user->type == 'admin')
                <a href="{{ showPicture('admin.profile', $user->profile) }}">
                    <img class="user-pic media-object img-circle" alt="{{ $user->name . " " . $user->lastname }}"
                        src="{{ showPicture('admin.profile', $user->profile) }}">
                </a>
                @endif

                @if($user->profile == 'default')
                <a href="#">
                    <img class="user-pic media-object img-circle" alt="{{ $user->name . " " . $user->lastname }}"
                        src="{{ showPicture(null, $user->profile) }}">
                </a>
                @endif

                <div class="t">
                    <h4 class="font-600"
                        style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                        نام :
                    </h4>
                    <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->name }}</h4>
                </div>

                <div class="t">
                    <h4 class="font-600"
                        style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                        نام خانوادگی :
                    </h4>
                    <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->lastname }}</h4>
                </div>

                <div class="t">
                    <h4 class="font-600"
                        style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                        نام کاربری :
                    </h4>
                    <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->username }}</h4>
                </div>

                <div class="t">
                    <h4 class="font-600"
                        style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                        رمز عبور :
                    </h4>
                    <h4 class="font-600 m-b-20" style="display: inline-block;">
                        @if(! Hash::check("raya-px724", $user->password))
                        {{ "Secret" }}
                        <i class="fa fa-lock"></i>
                        @else
                        {{ "raya-px724" }}
                        @endif
                    </h4>
                </div>

                <div class="t">
                    <h4 class="font-600"
                        style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                        شماره تماس :
                    </h4>
                    <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->phone }}</h4>
                </div>

                <div class="t">
                    <h4 class="font-600"
                        style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                        آدرس :
                    </h4>
                    <h4 class="font-600 m-b-20" style="display: inline-block;">{{ $user->address }}</h4>
                </div>


            </div>



            <div class="clear-fix"></div>

            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>

                    <h5 class="font-600 m-b-5">مدت زمان ثبت نام</h5>
                    <p>{{ verta($user->created_at)->formatDifference() }}</p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">تاریخ ثبت نام</h5>
                    <p class="date-show">{{ verta($user->created_at)->formatJalaliDate() }}</p>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>


    @if($user->isAdmin())
    <div class="col-md-7">
        <div class="card-box task-detail">
            <h4 class="header-title m-t-0 m-b-30">
                <i class="fa fa-shield i-fix"></i>
                <span>نقش ها و سطوح دسترسی مدیر</span>
            </h4>

            <table id="datatable" class="tac-table table table-striped table-bordered" style="border: 1px solid #dcdcdcdd;">
                <tr class="tac">
                    <td class="acl-list" style="background:#018c86;" colspan="4">نقش ها</td>
                </tr>
                @foreach($roles as $key => $role)
                    @if(openTr($key, 4))<tr>@endif
                        <td>{{ $role->title }}</td>
                    @if(closeTr($key, 4))</tr>@endif
                @endforeach
            </table>

            <table id="datatable" class="tac-table table table-striped table-bordered" style="border: 1px solid #dcdcdcdd !important;">
                <tr class="tac">
                    <td class="acl-list" style="background:#6eaaf5;" colspan="4">سطوح دسترسی</td>
                </tr>
                @foreach($permissions as $key => $permission)
                    @if(openTr($key, 4))<tr>@endif
                        <td>{{ $permission }}</td>
                    @if(closeTr($key, 4))</tr>@endif
                @endforeach
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
    @endif

</div>

@if(session()->has('UpdateCost'))
<script>
    var message = "هزینه مورد نظر با موفقیت بروزرسانی شد.";
   minMbox(message, 250);
</script>
@endif
@endsection
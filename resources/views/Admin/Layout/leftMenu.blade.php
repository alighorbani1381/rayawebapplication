@php
$fullName = auth()->user()->name . " " . auth()->user()->lastname;
$user = auth()->user();
@endphp
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                @if($user->profile != 'default')
                <img src="{{ showPicture('admin.profile', $user->profile)}}" alt="{{ $fullName }}"
                    title="{{ $fullName }}" class="img-circle img-thumbnail img-responsive">
                @else
                <img src="/admin/images/users/default.png" alt="{{ $fullName }}" title="{{ $fullName }}"
                    class="img-circle img-thumbnail img-responsive">
                @endif
                <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5>
                <a href="{{ route('admin.dashboard') }}">
                    {{ $fullName }}
                </a>
            </h5>
            <ul class="list-inline">
                <li>
                    <a href="{{ route('logout') }}" title="خروج" class="logout-button text-custom">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect active"><i class="fa fa-dashboard"></i>
                        <span> داشبورد </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-briefcase"></i> <span> مدیریت
                            خدمات</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('categories.index') }}">لیست خدمات</a></li>
                        <li><a href="{{ route('categories.create') }}">افزودن خدمات جدید</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-laptop"></i> <span> مدیریت پروژه
                            ها</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('projects.index') }}">لیست پروژه ها</a></li>
                        <li><a href="{{ route('projects.create') }}">افزودن پروژه جدید</a></li>
                    </ul>
                </li>



                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> مدیریت درآمد
                            ها</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('earnings.index') }}">لیست درآمد ها</a></li>
                        <li><a href="{{ route('earnings.create') }}">افزایش موجودی</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-dollar"></i> <span>مدیریت هزینه
                            ها</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('costs.index') }}">لیست هزینه</a></li>
                        <li><a href="{{ route('costs.create') }}">ثبت هزینه</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-check-square-o"></i> <span>مدیریت
                            هزینه های ثابت</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('static.index') }}">لیست هزینه های ثابت</a></li>
                        <li><a href="{{ route('static.create') }}">ثبت هزینه ثابت</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span> مدیریت کاربران
                        </span> <span class="menu-arrow fa-angle-left"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                        <li><a href="{{ route('users.create') }}">افزودن کاربر جدید</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.profile.index') }}" class="waves-effect">
                        <i class="fa fa-user"></i>
                        <span>پروفایل</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="logout-button waves-effect" title="خروج"><i class="fa fa-sign-out"></i>
                        <span> خروج </span> </a>
                </li>


            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- ========== Left Sidebar End ========== -->
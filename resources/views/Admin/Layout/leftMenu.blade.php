@php
$fullName = auth()->user()->name . " " . auth()->user()->lastname;
$user = auth()->user();

$accessCategory   = ACL::getCategories();
$accessProject    = ACL::getProjects();
$accessEarning    = ACL::getEarnings();
$accessCost       = ACL::getCosts();
$accessCostStatic = ACL::getCostStatic();
$accessUser       = ACL::getUsers();
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

                <!-- Introduction Start !-->
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect active"><i class="fa fa-dashboard"></i>
                        <span> داشبورد </span> </a>
                </li>
                <!-- Introduction End !-->

                @if($accessCategory || Gate::allows('Create-Category'))
                <!-- Category Item Start !-->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-briefcase"></i>
                        <span> مدیریت خدمات</span>
                        <span class="menu-arrow  fa-angle-left"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">

                        @if($accessCategory)
                        <li><a href="{{ route('categories.index') }}">لیست خدمات</a></li>
                        @endif

                        @can('Create-Category')
                        <li><a href="{{ route('categories.create') }}">افزودن خدمات جدید</a></li>
                        @endcan
                    </ul>
                </li>
                <!-- Category Item End !-->
                @endif

                @if($accessProject || Gate::allows('Create-Project'))
                <!-- Project Item Start !-->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-laptop"></i>
                        <span> مدیریت پروژه ها</span>
                        <span class="menu-arrow  fa-angle-left"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">

                        @if($accessProject)
                        <li><a href="{{ route('projects.index') }}">لیست پروژه ها</a></li>
                        @endif

                        @can('Create-Project')
                        <li><a href="{{ route('projects.create') }}">افزودن پروژه جدید</a></li>
                        @endcan
                    </ul>
                </li>
                <!-- Category Item End !-->
                @endif

                @if($accessEarning || Gate::allows('Create-Earning') )
                <!-- Earning Item Start !-->
                <li class="has_sub">

                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-money"></i>
                        <span> مدیریت درآمد ها</span>
                        <span class="menu-arrow  fa-angle-left"></span>
                    </a>

                    <ul class="list-unstyled" style="display: none;">
                        @if($accessEarning)
                        <li><a href="{{ route('earnings.index') }}">لیست درآمد ها</a></li>
                        @endif

                        @can('Create-Earning')
                        <li><a href="{{ route('earnings.create') }}">افزایش موجودی</a></li>
                        @endcan
                    </ul>
                </li>
                <!-- Earning Item Start !-->
                @endif

                @if($accessCost || Gate::allows('Create-Cost') )
                <!-- Cost Item Start !-->
                <li class="has_sub">

                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-dollar"></i>
                        <span>مدیریت هزینه ها</span>
                        <span class="menu-arrow  fa-angle-left"></span>
                    </a>

                    <ul class="list-unstyled" style="display: none;">

                        @if($accessCost)
                        <li><a href="{{ route('costs.index') }}">لیست هزینه</a></li>
                        @endif

                        @can('Create-Cost')
                        <li><a href="{{ route('costs.create') }}">ثبت هزینه</a></li>
                        @endcan

                    </ul>
                </li>
                <!-- Cost Item Start !-->
                @endif

                @if($accessCostStatic || Gate::allows('Create-Cost-Static'))
                <!-- Cost Static Item Start !-->
                <li class="has_sub">

                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-check-square-o"></i>
                        <span>مدیریت هزینه های ثابت</span>
                        <span class="menu-arrow  fa-angle-left"></span>
                    </a>

                    <ul class="list-unstyled" style="display: none;">

                        @if($accessCostStatic)
                        <li><a href="{{ route('static.index') }}">لیست هزینه های ثابت</a></li>
                        @endif

                        @can('Create-Cost-Static')
                        <li><a href="{{ route('static.create') }}">ثبت هزینه ثابت</a></li>
                        @endcan

                    </ul>

                </li>
                <!-- Cost Static Item Start !-->
                @endif

                @if($accessUser || Gate::allows('Create-User'))
                <!-- Users Item Start !-->
                <li class="has_sub">

                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-users"></i>
                        <span> مدیریت کاربران </span>
                        <span class="menu-arrow fa-angle-left"></span>
                    </a>

                    <ul class="list-unstyled">

                        @if($accessUser)
                        <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                        @endif

                        @can('Create-User')
                        <li><a href="{{ route('users.create') }}">افزودن کاربر جدید</a></li>
                        @endcan

                    </ul>
                </li>
                <!-- Users Item End !-->
                @endif


                @can('ACL-Control')
                <!-- ACL Item Start !-->
                <li class="has_sub">

                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-delicious"></i>
                        <span> مدیریت سطوح دسترسی </span>
                        <span class="menu-arrow fa-angle-left"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li><a href="{{ route('per.index') }}">لیست سطح دسترسی</a></li>
                        <li><a href="{{ route('per.create') }}">افزودن سطح دسترسی</a></li>
                        <li><a href="#">*******************</a></li>
                        <li><a href="{{ route('roles.index') }}">لیست نقش ها</a></li>
                        <li><a href="{{ route('roles.create') }}">افزودن نقش جدید</a></li>
                    </ul>

                </li>
                <!-- ACL Item End !-->
                @endcan



                <!-- Profile Item Start !-->
                <li>
                    <a href="{{ route('admin.profile.index') }}" class="waves-effect">
                        <i class="fa fa-male"></i>
                        <span>پروفایل</span>
                    </a>
                </li>
                <!-- Profile Item End !-->

                <!-- Logout Item Start !-->
                <li>
                    <a href="{{ route('logout') }}" class="logout-button waves-effect" title="خروج"><i
                            class="fa fa-sign-out"></i>
                        <span> خروج </span> </a>
                </li>
                <!-- Logout Item End !-->


            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
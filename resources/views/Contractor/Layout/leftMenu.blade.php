@php
$fullName = auth()->user()->name . " " . auth()->user()->lastname;
$image = auth()->user()->profile;
@endphp
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                @if($image != 'default')
                <img src="{{ showPicture('user.profile', $image) }}" alt="شما" title="شما"
                    class="img-circle img-thumbnail img-responsive">
                @else
                <img src="{{ showPicture('', $image) }}" alt="شما" title="شما"
                    class="img-circle img-thumbnail img-responsive">
                @endif
                <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5>
                <a href="{{ route('contractor.dashbord') }}">
                    {{ $fullName }}
                </a>
            </h5>
            <ul class="list-inline">
                <li>
                    <a href="{{ route('logout') }}" title="خروج" class="text-custom">
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
                    <a href="{{ route('contractor.dashbord') }}" class="waves-effect active"><i
                            class="fa fa-dashboard"></i> <span> داشبورد </span> </a>
                </li>


                <li>
                    <a href="{{ route('contractor.profile.index') }}" class="waves-effect">
                        <i class="fa fa-user"></i>
                        <span> حساب کاربری</span>
                    </a>
                </li>


                <li class="text-muted menu-title">بخش کاری</li>
                <li>
                    <a href="{{ route('contractor.projects.index') }}" class="waves-effect">
                        <i class="fa fa-laptop"></i>
                        @if($allProjects != 0)
                        <span class="label label-purple pull-right">{{ $allProjects }}</span>
                        @endif
                        <span> لیست پروژه ها </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contractor.projects.ongoing') }}" class="waves-effect">
                        <i class="fa fa-codepen"></i>
                        @if($ongoingProjects != 0)
                        <span class="label label-warning pull-right">{{ $ongoingProjects }}</span>
                        @endif
                        <span> پروژه های در دست اجرا </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contractor.projects.finished') }}" class="waves-effect">
                        <i class="fa fa-tags"></i>
                        @if($finishedProjects != 0)
                        <span class="label label-success pull-right">{{ $finishedProjects }}</span>
                        @endif
                        <span> پروژه های پایان یافته </span>
                    </a>
                </li>


                <li class="text-muted menu-title">بخش حسابداری</li>

                <li>
                    <a href="{{ route('contractor.earning.index') }}" class="waves-effect">
                        <i class="fa fa-money"></i>
                        @if($earning != 0)
                        <span class="label label-primary pull-right">{{ $earning }}</span>
                        @endif
                        <span> لیست پرداختی ها </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contractor.earning.credit') }}" class="waves-effect">
                        <i class="fa fa-dollar"></i>
                        @if($credit != 0)
                        <span class="label label-danger pull-right">{{ $credit }}</span>
                        @endif
                        <span> لیست بستانکاری ها </span>
                    </a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
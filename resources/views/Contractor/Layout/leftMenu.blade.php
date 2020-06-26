   @php
       $fullName = auth()->user()->name . " " . auth()->user()->lastname;
   @endphp
   <!-- ========== Left Sidebar Start ========== -->
   <div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="/admin/images/users/default.png" alt="{{ $fullName }}" title="{{ $fullName }}" class="img-circle img-thumbnail img-responsive">
                <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5>
                <a href="{{ route('contractor.dashboard') }}">
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
                    <a href="{{ route('contractor.dashboard') }}" class="waves-effect active"><i class="fa fa-dashboard"></i> <span> داشبورد </span> </a>
                </li>

              
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-laptop"></i> <span> مدیریت پروژه ها</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('projects.index') }}">لیست پروژه ها</a></li>
                        <li><a href="{{ route('projects.create') }}">پروژه</a></li>
                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> مدیریت درآمد ها</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('earnings.index') }}">لیست پرداختی ها</a></li>
                    </ul>
                </li 

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
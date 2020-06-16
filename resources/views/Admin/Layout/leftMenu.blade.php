   <!-- ========== Left Sidebar Start ========== -->
   <div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="/admin/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5><a href="#">اسم کاربر</a> </h5>
            <ul class="list-inline">
                <li>
                    <a href="#" >
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>

                <li>
                    <a href="#" class="text-custom">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">به پنل مدیریت خوش آمدید !</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i> <span> داشبورد </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-laptop"></i> <span> مدیریت پروژه ها</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('projects.index') }}">لیست پروژه ها</a></li>
                        <li><a href="{{ route('projects.create') }}">افزودن پروژه جدید</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-briefcase"></i> <span> مدیریت خدمات</span> <span class="menu-arrow  fa-angle-left"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('categories.index') }}">لیست خدمات</a></li>
                        <li><a href="{{ route('categories.create') }}">افزودن خدمات جدید</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span> مدیریت کاربران </span> <span class="menu-arrow fa-angle-left"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                        <li><a href="{{ route('users.create') }}">افزودن کاربر جدید</a></li>
                    </ul>
                </li>
                

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
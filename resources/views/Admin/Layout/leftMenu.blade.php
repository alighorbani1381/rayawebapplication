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
                <li class="text-muted menu-title">دسته بندی ها</li>

                <li>
                    <a href="index-2.html" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i> <span> داشبورد </span> </a>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span> مدیریت کاربران </span> <span class="menu-arrow fa-angle-left"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                        <li><a href="{{ route('users.create') }}">افزودن کاربر جدید</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span class="label label-warning pull-right">7</span><span> فرم ها </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="form-elements.html">فرم های عمومی</a></li>
                        <li><a href="form-advanced.html">فرم های پیشرفته</a></li>
                        <li><a href="form-validation.html">فرم ولیدشن</a></li>
                        <li><a href="form-wizard.html">فرم پیشفرض</a></li>
                        <li><a href="form-fileupload.html">فرم آپلود</a></li>
                        <li><a href="form-wysiwig.html">ادیتور 1</a></li>
                        <li><a href="form-xeditable.html">ادیتور 2</a></li>
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
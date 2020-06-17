@extends('Admin.Layout.main')
@section('title', 'جزئیات پروژه')
@section('header', 'جزئیات پروژه')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">متن یک</a></li>
                    <li><a href="#">متن دو</a></li>
                    <li><a href="#">متن سه</a></li>
                    <li class="divider"></li>
                    <li><a href="#">متن پا ورقی</a></li>
                </ul>
            </div>
            <div class="media m-b-20">
                <div class="media-left">
                    <a href="#"> <img class="media-object img-circle" alt="64x64" src="assets/images/users/avatar-2.jpg" style="width: 48px; height: 48px;"> </a>
                </div>
                <div class="media-body">

                    <h4 class="media-heading m-b-0">علی یدالهی</h4>
                    <span class="label label-danger">سطح ارتقا یافته</span>
                </div>
            </div>

            <h4 class="font-600 m-b-20">طراح واسط کاربری و برنامه نویس اندروید</h4>

            <p class="text-muted">
                ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد
            </p>

            <p class="text-muted">
                ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد
            </p>

            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>
                    <h5 class="font-600 m-b-5">تاریخ عضویت</h5>
                    <p> 22 مهر 1395 <small class="text-muted">1:00 ب ظ</small></p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">آخرین بازدید</h5>
                    <p> 17 آبان 1395 <small class="text-muted">12:00 ق ظ</small></p>
                </li>
            </ul>
            <div class="clearfix"></div>

             <div class="task-tags m-t-20">
                 <h5 class="font-600">برچسب ها</h5>
                <input type="text" value="اندروید,طراح واسط کاربری,وردپرس" data-role="tagsinput" placeholder="افزودن برچسب"/>
            </div>

            <div class="assign-team m-t-30">
                <h5 class="font-600 m-b-5">دنبال کنندگان</h5>
                <div>
                    <a href="#"> <img class="img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-2.jpg"> </a>
                    <a href="#"> <img class="img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-3.jpg"> </a>
                    <a href="#"> <img class="img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-5.jpg"> </a>
                    <a href="#"> <img class="img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-8.jpg"> </a>
                    <a href="#"><span class="add-new-plus"><i class="zmdi zmdi-plus"></i> </span></a>
                </div>
            </div>

            <div class="attached-files m-t-30">
                <h5 class="font-600">فایل های ارسال شده </h5>
                <div class="files-list">
                    <div class="file-box">
                        <a href="#"><img src="assets/images/attached-files/img-1.jpg" class="img-responsive img-thumbnail" alt="attached-img"></a>
                        <p class="font-13 m-b-5 text-muted"><small>فایل یک</small></p>
                    </div>
                    <div class="file-box">
                        <a href="#"><img src="assets/images/attached-files/img-2.jpg" class="img-responsive img-thumbnail" alt="attached-img"></a>
                        <p class="font-13 m-b-5 text-muted"><small>فایل دو</small></p>
                    </div>
                    <div class="file-box">
                        <a href="#"><img src="assets/images/attached-files/img-3.png" class="img-responsive img-thumbnail" alt="attached-img"></a>
                        <p class="font-13 m-b-5 text-muted"><small>فایل 3</small></p>
                    </div>
                    <div class="file-box m-l-15">
                        <div class="fileupload add-new-plus">
                            <span><i class="zmdi-plus zmdi"></i></span>
                            <input type="file" class="upload">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-right m-t-30">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                ذخیره
                            </button>
                            <button type="button"
                                    class="btn btn-default waves-effect">لغو
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end col -->

    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">متن یک</a></li>
                    <li><a href="#">متن دو</a></li>
                    <li><a href="#">متن سه</a></li>
                    <li class="divider"></li>
                    <li><a href="#">متن پا ورقی</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">بازخورد (6)</h4>

            <div>
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">نام کاربر</h4>
                        <p class="font-13 text-muted m-b-0">
                            <a href="#" class="text-primary">@نام کاربری</a>
                            ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود 
                        </p>
                        <a href="#" class="text-success font-13">جواب دادن</a>
                    </div>
                </div>
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-2.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">نام کاربر</h4>
                        <p class="font-13 text-muted m-b-0">
                            <a href="#" class="text-primary">@نام کاربری</a>
                            ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود 
                        </p>
                        <a href="#" class="text-success font-13">جواب دادن</a>
                        <div class="media">
                            <div class="media-left">
                                <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-3.jpg"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">نام کاربر</h4>
                                <p class="font-13 text-muted m-b-0">
                                    <a href="#" class="text-primary">@نام کاربری</a>
                                    ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. 
                                </p>
                                <a href="#" class="text-success font-13">جواب دادن</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">نام کاربر</h4>
                        <p class="font-13 text-muted m-b-0">
                            <a href="#" class="text-primary">@نام کاربری</a>
                            ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود 
                        </p>
                        <a href="#" class="text-success font-13">جواب دادن</a>
                    </div>
                </div>
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-2.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">نام کاربر</h4>
                        <p class="font-13 text-muted m-b-0">
                            <a href="#" class="text-primary">@نام کاربری</a>
                            ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود 
                        </p>
                        <a href="#" class="text-success font-13">جواب دادن</a>
                        <div class="media">
                            <div class="media-left">
                                <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-3.jpg"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">نام کاربر</h4>
                                <p class="font-13 text-muted m-b-0">
                                    <a href="#" class="text-primary">@نام کاربری</a>
                                    ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. 
                                </p>
                                <a href="#" class="text-success font-13">جواب دادن</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <input type="text" class="form-control input-sm" placeholder="دیدگاهی جدید بنویسید">
                    </div>
                </div>

            </div>
        </div>
    </div><!-- end col -->
</div>
@endsection
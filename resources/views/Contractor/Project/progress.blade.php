@extends('Contractor.Layout.main')
@section('title', 'پیشرفت پروژه')
@section('header', 'وضعیت پیشرفت پروژه')
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-box">

            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">فعال</a></li>
                    <li><a href="#">متن اول</a></li>
                    <li><a href="#">متن دوم</a></li>
                    <li class="divider"></li>
                    <li><a href="#">متن پاورقی</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">نمونه های نوار تغیرات</h4>

            <p class="text-muted m-b-30 font-13">
                انواع نوار های لغزنده تغیرات در این صفحه
            </p>

            <form class="form-horizontal">
                <div class="form-group">
                    <label for="range_01" class="col-sm-2 control-label">نمونه 1<span class="font-normal text-muted clearfix">شروع بدون هیچ پارامتری</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_01">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_02" class="col-sm-2 control-label"><b>نمونه 2</b><span class="font-normal text-muted f-s-12 clearfix">استفاده از کمترین و بیشترین حد محدوده</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_02">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_03" class="col-sm-2 control-label"><b>نمونه 3</b><span class="font-normal text-muted f-s-12 clearfix">استفاده از علامت "ريال"</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_03">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_04" class="col-sm-2 control-label"><b>نمونه 4</b><span class="font-normal text-muted f-s-12 clearfix">استفاده از مقادیر منفی</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_04">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_05" class="col-sm-2 control-label"><b>نمونه 5</b><span class="font-normal text-muted f-s-12 clearfix">پرش های 250 تایی</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_05">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_06" class="col-sm-2 control-label"><b>نمونه 6</b><span class="font-normal text-muted f-s-12 clearfix">استفاده از انتخاب رشته ها</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_06">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_07" class="col-sm-2 control-label"><b>نمونه 7</b><span class="font-normal text-muted f-s-12 clearfix">یک نمونه زیبای نمایشی</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_07">
                    </div>
                </div>
                <div class="form-group">
                    <label for="range_08" class="col-sm-2 control-label"><b>نمونه 8</b><span class="font-normal text-muted f-s-12 clearfix">نمونه غیر فعال</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_08">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
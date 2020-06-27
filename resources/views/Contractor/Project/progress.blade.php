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
                        <input type="text" id="progress">
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#progress").ionRangeSlider({
        min: 0,
        max: 100,
        from: 20
    });
    });
</script>
@endsection

@push('css')
   <!-- UI Range css -->
<link href="" rel="stylesheet" type="text/css">
        <!-- ION Slider -->
        <link href="{{ asset('admin/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('admin/plugins/ion-rangeslider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@push('js')
   <!-- UI Range Javascript -->
   <script src="{{ asset('admin/plugins/ion-rangeslider/ion.rangeSlider.min.js') }} "></script>
@endpush
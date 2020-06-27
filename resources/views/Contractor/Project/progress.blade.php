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

            <h4 class="header-title m-t-0 m-b-30">
                تغییر درصد پیشرفت پروژه

            </h4>

            <p class="text-muted m-b-30 font-13">
                با استفاده از ریبون درصد پیشرفت پروژه را تغییر دهید.
            </p>

            <form class="form-horizontal" method="post" action="{{ route('contractor.projects.store.progress') }}">
                @csrf
                <div class="form-group">
                    <label for="range_01" class="col-sm-2 control-label">
                        پیشرفت تغییرات
                        <span class="font-normal text-muted clearfix">شروع از مقدار قبلی</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" id="progress" name="progress">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"  class="btn btn-success waves-effect waves-light submit-button">
                        ذخیره تغییرات
                    </button>
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
        from: 20,
    });
    });
</script>
@endsection

@push('css')
<!-- ION Slider -->
<link href="{{ asset('admin/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/plugins/ion-rangeslider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet"
    type="text/css" />
@endpush

@push('js')
<!-- UI Range Javascript -->
<script src="{{ asset('admin/plugins/ion-rangeslider/ion.rangeSlider.min.js') }} "></script>
@endpush
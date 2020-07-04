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
                    <li><a href="{{ route('contractor.projects.show', $progressInfo->project_id) }}">نمایش جزئیات پروژه</a></li>
                    <li><a href="{{ route('contractor.projects.index') }}">لیست پروژه ها</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                تغییر درصد پیشرفت پروژه
                <span style="color:#da7a03;">{{ " « " . $progressInfo->title . " » "}}</span>
            </h4>

            <p class="text-muted m-b-30 font-13">
                با استفاده از ریبون درصد پیشرفت پروژه را تغییر دهید.
            </p>

            <form class="form-horizontal" method="post" action="{{ route('contractor.projects.store.progress') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $progressInfo->id }}">
                <input type="hidden" name="project" value="{{ $progressInfo->project_id }}">
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
        from: {{ $progressInfo->progress }},
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
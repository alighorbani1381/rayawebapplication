@extends('Admin.Layout.main')
@section('title', 'ثبت هزینه')
@section('header', 'ثبت هزینه')
@push('js')
<script src="{{ asset('admin/js/customJS/costs.js') }} "></script>
@endpush
@section('content')

@if($errors->any())
<div class="row">
    <div class="col-md-8 col-lg-offset-2">
        <div class="card-box">
            <h3 class="header-title btn btn-danger waves-effect waves-light">پیغام های خطا</h3>
            @error('title')
            <div class=" alert alert-danger">{{ $message }}</div>
            @enderror

            @error('description')
            <div class=" alert alert-danger">{{ $message }}</div>
            @enderror

            @error('money_paid')
            <div class=" alert alert-danger">{{ $message }}</div>
            @enderror

            @error('project_id')
            <div class=" alert alert-danger">{{ $message }}</div>
            @enderror

            @error('status')
            <div class=" alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
@endif

{{-- Start Detail about This Feature --}}
<div class="row">
    <div class="col-md-8 col-lg-offset-2">
        <div class="card-box">
            <button class="costs-button btn btn-primary waves-effect waves-light pay-moeny" data-toggle="modal"
                data-target="#pay-user-modal">
                <i class="fa fa-line-chart" style="vertical-align: -3px;"></i>&nbsp;
                ثبت هزینه های مربوط به پروژه و کارمندان
            </button>
            <p style="margin:20px 0;">
                در این قسمت شما میتونید هزینه های مربوط به پروژه ها و یا کارمندان خود را ثبت کنید.
            </p>
            <p>
                این هزینه ها به سه صورت هستند.
            </p>
            <p>
                <strong>2-</strong>
                <strong>هزینه های پایه ای : </strong>
                این هزینه ها بیشتر مربوط به خود پروژه میشن
                مثلا (هزینه هاست و دامین و ...).
            </p>

            <p>
                <strong>2-</strong>
                <strong>پرداخت حقوق کارمندان سطح 1 : </strong>
                (کسانی که در انجام پروژه مشارکت دارند و بابت انجام پروژه حقوق دریافت می کنند)
            </p>
            <p>
                <strong>3-</strong>
                <strong>پرداخت حقوق کارمندان سطح 2 :</strong>

                (کسانی که ممکنه در انجام پروژه ها مشارکت نکنند برای مثال حقوق منشی و حقوق خود مدیر یا پرداخت تشویقی به
                کارمندان که ارتباطی به پروژه ندارد.)
            </p>
            <p>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>&nbsp;
                    <strong>راهنمایی:</strong>
                    ثبت هر دوی این نوع هزینه ها از همین پنل و تنها با کلیک بر روی
                    <span style="font-weight: bold; color:blue;">دکمه آبی</span>
                    رنگ امکان پذیر است.
                </div>
            </p>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-lg-offset-2">
        <div class="card-box">
            <button class="costs-button btn btn-purple waves-effect waves-light pay-moeny" data-toggle="modal"
                data-target="#pay-external-modal">
                <i class="fa fa-external-link" style="vertical-align: -3px;"></i>&nbsp;
                ثبت هزینه های جانبی
            </button>
            <p style="margin:20px 0;">
                در این قسمت شما میتونید هزینه های جانبی که ارتباطی با هزینه های پروژه ندارن رو به راحتی ثبت کنید.
            </p>
            <p style="margin:20px 0;">
                این هزینه ها هم به دو صورت زیر هستند.
            </p>
            <p>
                1-
                هزینه های از پیش تعیین شده (ثبت شده به عنوان هزینه ثابت) مثل قبض آب و برق و ...
            </p>

            <p>
                2-
                هزینه های از پیش تعریف نشده مثلا
                خرید اسپلیت برای شرکت.
            </p>
            <p>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>&nbsp;
                    <strong>راهنمایی:</strong>
                    ثبت هر دوی این نوع هزینه ها از همین پنل و تنها با کلیک بر روی
                    <span style="font-weight: bold; color:rgb(83, 10, 167);">دکمه بنفش</span>
                    رنگ امکان پذیر است.
                </div>
            </p>
        </div>
    </div>
</div>
{{-- End Detail about This Feature --}}


{{-- Modals Start --}}

<!-- Modal Pay Projet & User Start End -->
<div class="row">
    <!-- Modal Pay User Cost Start -->
    <div id="pay-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:54em;">
            <form id="project-form" action="{{ route('costs.store') }}" method="post">
                @csrf
                <input type="hidden" name="storeType" value="project">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">ثبت هزینه های مربوط به پروژه</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">عنوان هزینه</label>
                                    <input type="text" class="form-control" name="title" id="field-3"
                                        placeholder="عنوان هزینه را وارد کنید ..."
                                        value="@if(session()->has('ProjectStore')){{ old('title') }}@endif">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">میزان هزینه</label>
                                    <input type="number" class="form-control" name="money_paid" id="field-3"
                                        placeholder="میزان هزینه را وارد کنید ..."
                                        value="@if(session()->has('ProjectStore')){{ old('money_paid') }}@endif">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">توضیحات هزینه</label>
                                    <textarea class="form-control autogrow" id="field-7" name="description"
                                        placeholder="توضیحات هزینه را وارد کنید ..."
                                        style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">@if(session()->has('ProjectStore')){{ old('description') }}@endif</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">نوع هزینه</label>
                                    <select class="form-control" name="type">
                                        <optgroup label="پیش فرض">
                                            <option value="0">ندارد</option>
                                        </optgroup>
                                        @php $count = 0; @endphp
                                        @foreach($types as $type)
                                        @if($type->sub_cats->count() != 0)
                                        <optgroup label="{{ $type->title }} ">
                                            @foreach($type->sub_cats as $subCat)
                                            <option value="{{ $subCat->id }}">{{ $subCat->title }} </option>
                                            @endforeach
                                        </optgroup>
                                        @php $count += 1; @endphp
                                        @endif
                                        @endforeach

                                        @if($count == 0)
                                        <option disabled value="null">موردی برای نمایش وجود ندارد</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin: 11px -8px;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">پرداخت به کارمند</label>
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-paid" id="project-pay" type="radio" name="contractor_pay"
                                            value="true">

                                        <div class="state p-success">
                                            <label>پرداخت بابت پروژه</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>

                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-paid" id="normal-pay" type="radio" name="contractor_pay"
                                            value="without-project">

                                        <div class="state p-success">
                                            <label>پرداخت غیر از پروژه</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>


                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-unpaid" id="deactive" type="radio" name="contractor_pay"
                                            checked value="false">

                                        <div class="state p-danger">
                                            <label>عدم پرداخت</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="project-box">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">پروژه</label>
                                    <select class="form-control" name="project_id" id="project">
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->title . " - " . $project->unique_id}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <svg class="ajax-loading"
                                        style="display:none; width: 48px;position: absolute;height: 48px;margin: 0px auto;left: 6px;  top: 22px;margin: auto; background: none; display: block; shape-rendering: auto;"
                                        width="200px" height="200px" viewBox="0 0 100 100"
                                        preserveAspectRatio="xMidYMid">
                                        <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#2c73dd"
                                            stroke-dasharray="50.26548245743669 50.26548245743669" fill="none"
                                            stroke-linecap="round" transform="rotate(325.951 50 50)">
                                            <animateTransform attributeName="transform" type="rotate"
                                                repeatCount="indefinite" dur="0.3s" keyTimes="0;1"
                                                values="0 50 50;360 50 50"></animateTransform>
                                        </circle>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="contractor-mainbox" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label" id="contractor-label">کارمند</label>
                                    <select class="form-control" name="contractor_id" id="contractors-box">
                                    </select>
                                </div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col-md-12" style="margin: 11px -8px;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">وضعیت</label>
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-paid" type="radio" name="status" checked value="paid">

                                        <div class="state p-success">
                                            <label>پرداخت</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>


                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-unpaid" type="radio" name="status" value="unpaid">

                                        <div class="state p-danger">
                                            <label>عدم پرداخت</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                        <button type="reset" id="clear-form" class="btn btn-warning waves-effect">پاک کردن</button>
                        <button type="submit" id="project-submit" class="btn btn-success waves-effect waves-light">ثبت
                            هزینه برای پروژه</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Pay Project & User Cost End -->



<!-- Modal Pay External Costs Start -->
<div id="pay-external-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{ route('costs.store') }}" method="post">
            @csrf
            <input type="hidden" name="storeType" value="external">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ثبت هزینه های جانبی</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">عنوان هزینه</label>
                                <input type="text" class="form-control" name="title" id="field-3"
                                    placeholder="عنوان هزینه را وارد کنید ..."
                                    value="@if(session()->has('ExtenalStore')){{ old('title') }}@endif">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">میزان هزینه</label>
                                <input type="number" class="form-control" name="money_paid" id="field-3"
                                    placeholder="میزان هزینه را وارد کنید ..."
                                    value="@if(session()->has('ExtenalStore')){{ old('money_paid') }}@endif">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="field-7" class="control-label">توضیحات هزینه</label>
                                <textarea class="form-control autogrow" id="field-7" name="description"
                                    placeholder="توضیحات هزینه را وارد کنید ..."
                                    style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">@if(session()->has('ExtenalStore')){{ old('description') }}@endif</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="field-7" class="control-label">نوع هزینه</label>
                                <select class="form-control" name="type">
                                    <optgroup label="پیش فرض">
                                        <option value="0">ندارد</option>
                                    </optgroup>
                                    @php $count = 0; @endphp
                                    @foreach($types as $type)
                                    @if($type->sub_cats->count() != 0)
                                    <optgroup label="{{ $type->title }} ">
                                        @foreach($type->sub_cats as $subCat)
                                        <option value="{{ $subCat->id }}">{{ $subCat->title }} </option>
                                        @endforeach
                                    </optgroup>
                                    @php $count += 1; @endphp
                                    @endif
                                    @endforeach

                                    @if($count == 0)
                                    <option disabled value="null">موردی برای نمایش وجود ندارد</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12" style="margin: 11px -8px;">
                            <div class="form-group">
                                <label class="col-md-2 control-label">وضعیت</label>
                                <div class="pretty p-icon p-round p-pulse">
                                    <input class="earning-paid" type="radio" name="status" checked value="paid">

                                    <div class="state p-success">
                                        <label>پرداخت شده</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                        <i class="icon mdi mdi-check"></i>
                                    </div>
                                </div>


                                <div class="pretty p-icon p-round p-pulse">
                                    <input class="earning-unpaid" type="radio" name="status" value="unpaid">

                                    <div class="state p-danger">
                                        <label>پرداخت نشده</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                        <i class="icon mdi mdi-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                    <button type="reset" class="btn btn-warning waves-effect">پاک کردن</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">ثبت هزینه جانبی</button>
                </div>
        </form>
    </div>
</div>
<!-- Modal Pay External Costs End -->

@endsection
@extends('Admin.Layout.main')
@section('title', 'ثبت هزینه')
@section('header', 'ثبت هزینه')
{{-- @push('js')

@endpush --}}
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

<div class="row">
    <div class="col-md-8 col-lg-offset-2">
        <div class="card-box">
            <button class="btn btn-primary waves-effect waves-light pay-moeny" data-toggle="modal"
                data-target="#pay-user-modal">
                <i class="fa fa-line-chart"></i>&nbsp;
                ثبت هزینه های مربوط به پروژه
            </button>
            <p style="margin:20px 0;">
                در این قسمت شما میتونید هزینه های مربوط به پروژه رو ثبت کنید.
            </p>
            <p>
                این هزینه ها به دو صورت هستند.
            </p>
            <p>
                1-
                هزینه های پایه ای که مربوط به خود پروژه میشن
                مثلا (هزینه هاست و دامین و ...).
            </p>

            <p>
                2-
                هزینه های مربوط به حق الزحمه پیمانکاران
                (پرداخت حقوق).
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
            <button class="btn btn-purple waves-effect waves-light pay-moeny" data-toggle="modal"
                data-target="#pay-external-modal">
                <i class="fa fa-life-ring"></i>&nbsp;
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


{{-- Modals Start --}}

<!-- Modal Pay User Start End -->
<div class="row">
    <!-- Modal Pay User Cost Start -->
    <div id="pay-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{ route('costs.store') }}" method="post">
                @csrf
                <input type="hidden" name="storeType" value="project">
                {{-- <input type="hidden" name="contractor_pay" value="true"> --}}
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
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">پروژه</label>
                                    <select class="form-control" name="project_id">
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->title . " - " . $project->unique_id}}
                                        </option>
                                        @endforeach
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

                        <div class="row" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">پیمانکار</label>
                                    <select class="form-control" name="contractor_id" id="contractors-box">
                                        <option value="">علی</option>
                                        <option value="">حسن</option>
                                        <option value="">رضا</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">ثبت هزینه</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Pay User Cost End -->



<!-- Modal Pay External Costs Start -->
<div id="pay-external-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">پرداخت هزینه های جانبی</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">نام</label>
                            <input type="text" class="form-control" id="field-1" placeholder="علی">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">نام خانوادگی</label>
                            <input type="text" class="form-control" id="field-2" placeholder="یدالهی">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">آدرس</label>
                            <input type="text" class="form-control" id="field-3" placeholder="آدرس">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-4" class="control-label">شهر</label>
                            <input type="text" class="form-control" id="field-4" placeholder="بابل">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">کشور</label>
                            <input type="text" class="form-control" id="field-5" placeholder="ایران">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-6" class="control-label">کد پستی</label>
                            <input type="text" class="form-control" id="field-6" placeholder="123456">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">اطلاعات شخصی</label>
                            <textarea class="form-control autogrow" id="field-7" placeholder="هر چیزی راجب به خودتان"
                                style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-info waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Pay External Costs End -->

@endsection
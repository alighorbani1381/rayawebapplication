@extends('Admin.Layout.main')
@section('title', 'افزودن پروژه')
@section('header', 'ایجاد پروژه')
@push('css')
<link href="{{ asset('admin/css/persian-datepicker.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
<script src="{{ asset('admin/js/customJS/projects.js') }} "></script>
<script src="{{ asset('admin/js/persian-date.min.js') }} "></script>
<script src="{{ asset('admin/js/persian-datepicker.js') }} "></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".persian-date").persianDatepicker({
        format: 'YYYY-MM-DD',	
        initialValueType: 'gregorian',
        });
    });
</script>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-10 col-lg-offset-1">
        <div class="card-box">
            <div class="row">
                <form class="form-vertical" method="post" action="{{ route('projects.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="col-lg-6">
                        <h4 class="header-title m-t-0 m-b-30">
                            <i class="fa fa-map"></i>
                            اطلاعات کلی پروژه
                        </h4>

                        <div class="form-group">
                            <label class="col-md-3 control-label">عنوان پروژه</label>
                            <div class="col-md-9">
                                <input type="text" name="title" required class="form-control" value="{{ old ('title') }}"
                                    placeholder="عنوان پروژه را وارد کنید ...">
                                @error('title')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">مربوطه به خدمات</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="categories[]" multiple>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-3 control-label">توضیحات پروژه</label>
                            <div class="col-md-9">
                                <textarea class="form-control txt-custom"
                                    placeholder="توضیحات مربوط به پروژه را وارد کنید ..." name="description"
                                    rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">قیمت (تومان)</label>
                            <div class="col-md-9">
                                <input type="number" required  placeholder="قیمت این پروژه را وارد کنید ..." name="price"
                                    class="form-control" value="{{ old ('price') }}" id="price">

                                @error('price')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h4 class="header-title m-t-0 m-b-30">
                            <i class="fa fa fa-hourglass-start"></i>
                            نحوه انجام پروژه
                        </h4>


                        <div class="form-group">
                            <label class="col-md-3 control-label">انجام می شود توسط:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="contractors[]" multiple>
                                    @foreach($contractors as $contractor)
                                    <option value="{{ $contractor->id }}">{{ $contractor->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">تاریخ شروع کار </label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="تاریخ شروع کار را وارد کنید ..." name="date_start"
                                    class="form-control persian-date" value="{{ old ('date_start') }}">
                                @error('date_start')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">زمان تحویل پروژه (روز)</label>
                            <div class="col-md-9">
                                <input type="number" required placeholder="زمان تحویل پروژه بر حسب روز را وارد کنید ..."
                                    name="complete_after" class="form-control" value="{{ old ('complete_after') }}">
                                @error('complete_after')
                                <div class="alert alert-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>


                    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-lg-offset-1">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="header-title m-t-0 m-b-30">
                        <i class="fa fa-info-circle"></i>
                        اطلاعات کارفرما
                    </h4>

                    <div class="form-group">
                        <label class="col-md-3 control-label">نام</label>
                        <div class="col-md-9">
                            <input type="text" required  name="name" class="form-control" value="{{ old ('name') }}"
                                placeholder="نام کارفرما را وارد کنید ...">
                            @error('name')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">نام خانوادگی</label>
                        <div class="col-md-9">
                            <input type="text" required  name="lastname" class="form-control" value="{{ old ('lastname') }}"
                                placeholder="نام خانوادگی کارفرما را وارد کنید ...">
                            @error('lastname')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">نام پدر</label>
                        <div class="col-md-9">
                            <input type="text" required name="father_name" class="form-control" value="{{ old ('father_name') }}"
                                placeholder="نام پدر کارفرما را وارد کنید ...">
                            @error('father_name')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">شماره تماس کارفرما</label>
                        <div class="col-md-9">
                            <input type="text" required name="phone" class="form-control" value="{{ old ('phone') }}"
                                placeholder="شماره تماس کارفرما را وارد کنید ...">
                            @error('phone')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label">آدرس دقیق کارفرما</label>
                        <div class="col-md-9">
                            <textarea class="form-control txt-custom" required
                                placeholder="آدرس کارفرما را به صورت دقیق وارد کنید ..." name="address"
                                rows="3">{{ old('address') }}</textarea>
                            @error('address')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">کد ملی</label>
                        <div class="col-md-9">
                            <input type="text" required name="meli_code" class="form-control" value="{{ old ('address') }}"
                                placeholder="کد ملی کارفرما را وارد کنید ...">
                            @error('meli_code')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">تصویر کد ملی</label>
                        <div class="col-md-9">
                            <input type="file" name="meli_image">
                            @error('meli_image')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>





                </div>

                <div class="col-lg-6">
                    <h4 class="header-title m-t-0 m-b-30">
                        <i class="fa fa-newspaper-o"></i>
                        قرارداد پروژه
                    </h4>


                    <div class="form-group">
                        <label class="col-md-3 control-label">تاریخ شروع قرارداد </label>
                        <div class="col-md-9">
                            <input type="text"  required placeholder="تاریخ شروع قرارداد را وارد کنید ..." name="contract_started"
                                class="form-control persian-date" value="{{ old ('contract_started') }}">
                            @error('contract_started')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">تاریخ پایان قرارداد </label>
                        <div class="col-md-9">
                            <input type="text" required placeholder="تاریخ پایان قرارداد را وارد کنید ..." name="completed_at"
                                class="form-control persian-date" value="{{ old ('completed_at') }}">
                            @error('completed_at')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">تصویر قرارداد</label>
                        <div class="col-md-9">
                            <input type="file" name="contract_image">
                            @error('contract_image')
                            <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success waves-effect submit-button">
                            ایجاد این پروژه
                        </button>

                    </div>

                </div>

                </form>
            </div>
        </div>
    </div>
</div>

@if(session()->has('EarningProblem'))
<script>
    var title = "پروژه ای برای افزایش در آمد شما وجود نداره!";
var message = "برای این که بتوانید در آمد خود را ثبت کنید باید پروژه ای وجود داشته باشه برای این کار از همین صفحه پروژه رو ایجاد کن.";
var btnText= "متوجه شدم" ;
maxMbox(title, message, 'warning', btnText, 250);
</script>
@endif
@endsection
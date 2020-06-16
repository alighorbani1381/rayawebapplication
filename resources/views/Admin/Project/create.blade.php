@extends('Admin.Layout.main')
@section('title', 'افزودن پروژه')
@section('header', 'ایجاد پروژه')
@section('content')
<div class="row">
    <div class="col-sm-10 col-lg-offset-1">
        <div class="card-box">
            <div class="row">
                <form class="form-vertical" method="post" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                    

                    <div class="col-lg-6">
                        <h4 class="header-title m-t-0 m-b-30">
                            <i class="fa fa-map"></i>
                            اطلاعات کلی پروژه
                        </h4>

                        <div class="form-group">
                            <label class="col-md-3 control-label">عنوان پروژه</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" value=""
                                    placeholder="عنوان پروژه را وارد کنید ...">
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
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">قیمت (تومان)</label>
                            <div class="col-md-9">
                                <input type="number" placeholder="قیمت این پروژه را وارد کنید ..." name="price"
                                    class="form-control" value="">
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
                                <input type="date" placeholder="تاریخ اتمام پروژه را وارد کنید ..." name="completed_at"
                                    class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">زمان تحویل پروژه (روز)</label>
                            <div class="col-md-9">
                                <input type="number" placeholder="زمان تحویل پروژه بر حسب روز را وارد کنید ..."
                                    name="price" class="form-control" value="">
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
                            <input type="text" name="name" class="form-control" value=""
                                placeholder="نام کارفرما را وارد کنید ...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">نام خانوادگی</label>
                        <div class="col-md-9">
                            <input type="text" name="lastname" class="form-control" value=""
                                placeholder="نام خانوادگی کارفرما را وارد کنید ...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">نام پدر</label>
                        <div class="col-md-9">
                            <input type="text" name="father_name" class="form-control" value=""
                                placeholder="نام پدر کارفرما را وارد کنید ...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">شماره تماس کارفرما</label>
                        <div class="col-md-9">
                            <input type="text" name="lastname" class="form-control" value=""
                                placeholder="شماره تماس کارفرما را وارد کنید ...">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label">آدرس دقیق کارفرما</label>
                        <div class="col-md-9">
                            <textarea class="form-control txt-custom"
                                placeholder="آدرس کارفرما را به صورت دقیق وارد کنید ..." name="description"
                                rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">کد ملی</label>
                        <div class="col-md-9">
                            <input type="text" name="melli_code" class="form-control" value=""
                                placeholder="کد ملی کارفرما را وارد کنید ...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">تصویر کد ملی</label>
                        <div class="col-md-9">
                            <input type="file" name="melli_image">
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
                            <input type="date" placeholder="تاریخ اتمام پروژه را وارد کنید ..." name="completed_at"
                                class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">تاریخ پایان قرارداد </label>
                        <div class="col-md-9">
                            <input type="date" placeholder="تاریخ اتمام پروژه را وارد کنید ..." name="completed_at"
                                class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">تصویر قرارداد</label>
                        <div class="col-md-9">
                            <input type="file" name="image[0]">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="submit">
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
@endsection
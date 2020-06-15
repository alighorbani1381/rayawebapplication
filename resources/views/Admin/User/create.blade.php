@extends('Admin.Layout.main')
@section('title', 'افزودن کاربر')
@section('header', 'افزودن کاربر جدید')
@section('content')
<div class="row">
    <div class="col-sm-10 col-lg-offset-1">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">مشخصات کاربر</h4>
            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" action="{{ route('users.index') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-2 control-label">نام کاربر</label>
                            <div class="col-md-10">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="نام کاربر را وارد کنید ...">
                                @error('name')
                                <div class="alert alert-danger">وارد کردن نام کاربر الزامی است.</div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-2 control-label">نام خانوادگی کاربر</label>
                            <div class="col-md-10">
                                <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control"
                                    placeholder="نام خانوادگی کاربر را وارد کنید ...">
                                @error('lastname')
                                <div class="alert alert-danger">وارد کردن نام خانوادگی کاربر الزامی است.</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">شماره تماس</label>
                            <div class="col-md-10">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                    placeholder="شماره تماس کاربر را وارد کنید ...">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">آدرس</label>
                            <div class="col-md-10">
                                <textarea class="form-control txt-custom"
                                    placeholder="آدرس را وارد کنید ..." name="address" rows="5">{{ old('address') }}</textarea>
                                @error('address')
                                <div class="alert alert-danger">وارد کردن آدرس الزامی است.</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">نوع کاربر</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="type">
                                    <option value="admin" selected="">مدیر</option>
                                    <option value="contractor">کارمند</option>
                                </select>
                            </div>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">اطلاعات ورود به سامانه</h4>
                        <div class="form-group">
                            <label class="col-md-2 control-label">نام کاربری</label>
                            <div class="col-md-10">
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                    placeholder="نام کاربری را وارد کنید ...">
                                @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">رمزعبور</label>
                            <div class="col-md-10">
                                <input type="text"  readonly class="form-control" value="raya-px724">
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <button type="submit" class="btn btn-success waves-effect waves-light submit-button">افزودن
                                کاربر</button>
                        </div>
                    </form>
                </div><!-- end col -->

            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>
@endsection
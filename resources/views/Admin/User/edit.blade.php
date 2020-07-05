@extends('Admin.Layout.main')
@section('title', 'ویرایش کاربر')
@section('header', 'ویرایش کاربران')
@section('content')
<div class="row">
    <div class="col-sm-10 col-lg-offset-1">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">مشخصات کاربر</h4>
            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-md-2 control-label">نام کاربر</label>
                            <div class="col-md-10">
                                <input type="text" name="name" required value="{{ $user->name }}" class="form-control"
                                    placeholder="نام کاربر را وارد کنید ...">
                                @error('name')
                                <div class="alert alert-danger">وارد کردن نام کاربر الزامی است.</div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-2 control-label">نام خانوادگی کاربر</label>
                            <div class="col-md-10">
                                <input type="text" name="lastname" required value="{{ $user->lastname }}"
                                    class="form-control" placeholder="نام خانوادگی کاربر را وارد کنید ...">
                                @error('lastname')
                                <div class="alert alert-danger">وارد کردن نام خانوادگی کاربر الزامی است.</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">شماره تماس</label>
                            <div class="col-md-10">
                                <input type="text" name="phone" required value="{{ $user->phone }}" class="form-control"
                                    placeholder="شماره تماس کاربر را وارد کنید ...">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">آدرس</label>
                            <div class="col-md-10">
                                <textarea class="form-control txt-custom" required placeholder="آدرس را وارد کنید ..."
                                    name="address" rows="5">{{ $user->address }}</textarea>
                                @error('address')
                                <div class="alert alert-danger">وارد کردن آدرس الزامی است.</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">نوع کاربر</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="type" disabled>
                                    @if($user->type == 'admin')
                                    <option value="admin">مدیر</option>
                                    @else
                                    <option value="contractor">کارمند</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">اطلاعات ورود به سامانه</h4>
                        <div class="form-group">
                            <label class="col-md-2 control-label">نام کاربری</label>
                            <div class="col-md-10">
                                <input type="text" name="username" required value="{{ $user->username }}"
                                    class="form-control" placeholder="نام کاربری را وارد کنید ...">
                                @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light submit-button">
                                ویرایش کاربر
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
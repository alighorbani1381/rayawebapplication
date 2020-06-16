@extends('Admin.Layout.main')
@section('title', 'ویرایش خدمات')
@section('header', 'ویرایش خدمات')
@section('content')
<div class="row">
    <div class="col-sm-8 col-lg-offset-2">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">
                ویرایش خدمت
                <b> « {{ $category->title }} » </b>
            </h4>
            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" role="form" action="{{ route('categories.update', $category->id) }}"
                        method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-md-2 control-label">عنوان خدمات</label>
                            <div class="col-md-10">
                                <input type="text" name="title" class="form-control" value="{{ $category->title }}"
                                    placeholder="عنوان خدمت را وارد کنید ...">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">توضیحات</label>
                            <div class="col-md-10">
                                <textarea class="form-control txt-custom" placeholder="توضیحات خدمت را وارد کنید ..."
                                    name="description" rows="5">{{ $category->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">سرگروه</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="child">
                                    <option value="0" selected>ندارد</option>
                                    @foreach($mainCategories as $val)
                                    <option @if($category->child == $val->id) {{ "selected" }} @endif
                                        value="{{ $val->id }}">
                                        {{ $val->title}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('child')
                                <div class="alert alert-danger">{{ $description }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light submit-button">
                                ویرایش خدمت
                                </button>
                        </div>
                    </form>
                </div><!-- end col -->

            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>

@if(session()->has('CategoryUpdateFail'))
    <script>maxMbox("اعمال تغییرات با خطا مواجه شد!", "این مورد خود سرگروه است و نمی تواند زیر گروه شود", "error", "آها",350 );</script>
@endif

@endsection
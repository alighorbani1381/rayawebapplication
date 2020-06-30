@extends('Admin.Layout.main')
@section('title', 'افزودن هزینه ثابت جدید')
@section('header', 'افزودن هزینه ثابت جدید')
@section('content')
<div class="row">
    <div class="col-sm-8 col-lg-offset-2">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30"> افزودن هزینه ثابت</h4>
            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" role="form" action="{{ route('static.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-2 control-label">عنوان هزینه ثابت</label>
                            <div class="col-md-10">
                                <input type="text" name="title" required class="form-control" value="{{ old('title') }}"
                                    placeholder="عنوان هزینه ثابت را وارد کنید ...">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">توضیحات ثابت</label>
                            <div class="col-md-10">
                                <textarea class="form-control txt-custom" required placeholder="توضیحات هزینه ثابت را وارد کنید ..."
                                    name="description" rows="5">{{ old('description') }}</textarea>
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
                                    @foreach($mainCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title}} </option>
                                    @endforeach
                                </select>
                                @error('child')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success waves-effect waves-light submit-button">
                                افزودن هزینه ثابت    
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
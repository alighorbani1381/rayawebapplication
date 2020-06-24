@extends('Admin.Layout.main')
@section('title', 'ویرایش هزینه')
@section('header', 'ویرایش هزینه')
@section('content')
@php
$costType = $cost['type'];
$cost = $cost['content'];
@endphp
<div class="row">
    <div class="col-sm-8 col-lg-offset-2">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">
                ویرایش هزینه
                {{ " " . "«" .$cost->title . "»"}}
            </h4>

            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" role="form" action="{{ route('static.update', $cost->id) }}"
                        method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-md-2 control-label">عنوان هزینه</label>
                            <div class="col-md-10">
                                <input type="text" name="title" class="form-control" value="{{ $cost->title }}"
                                    placeholder="عنوان هزینه را وارد کنید ...">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">میزان هزینه</label>
                            <div class="col-md-10">
                                <input type="number" name="money_paid" class="form-control" value="{{ $cost->title }}"
                                    placeholder="میزان هزینه را وارد کنید ...">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">توضیحات هزینه</label>
                            <div class="col-md-10">
                                <textarea class="form-control txt-custom"
                                    placeholder="توضیحات هزینه ثابت را وارد کنید ..." name="description"
                                    rows="5">{{ $cost->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light submit-button">
                                ویرایش هزینه ثابت
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
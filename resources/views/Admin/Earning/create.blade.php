@extends('Admin.Layout.main')
@section('title', 'افزودن درآمد')
@section('header', 'افزایش موجودی')
@push('js')
<script src="{{ asset('admin/js/customJS/earnings.js') }} "></script>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-8 col-lg-offset-2">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30" style="display: inline-block">افزودن در آمد جدید</h4>
            <button type="submit" id="add-earning-box" class="btn btn-primary waves-effect waves-light submit-button"
                style="margin-bottom:15px;">
                افزودن
            </button>

            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" role="form" action="{{ route('earnings.store') }}" method="post">
                        @csrf
                                        
                        @if($errors->any())
                        @error('project')
                        <div class="form-group">
                            <label class="col-md-2 control-label">خطای پروژه:</label>
                            <div class="col-sm-10">
                                <div class="form-control alert alert-danger">
                                    انتخاب فیلد پروژه الزامی است.
                                </div>
                            </div>
                        </div>
                        @enderror

                        @error('title.*')
                        <div class="form-group">
                            <label class="col-md-2 control-label">خطای عنوان:</label>
                            <div class="col-sm-10">
                                <div class="form-control alert alert-danger">
                                    وارد کردن فیلد های عنوان الزامی است.
                                </div>
                            </div>
                        </div>
                        @enderror

                        @error('received_money.*')
                        <div class="form-group">
                            <label class="col-md-2 control-label">خطای میزان درآمد:</label>
                            <div class="col-sm-10">
                                <div class="form-control alert alert-danger">
                                    اطلاعات وارد شده در فیلد میزان در آمد اشتباه می باشد.
                                </div>
                            </div>
                        </div>
                        @enderror

                        @endif

                        <div class="form-group">
                            <label class="col-md-2 control-label">پروژه</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="project">
                                    @foreach($projects as $project)
                                    <option price="{{ $project->price }}" value="{{ $project->id }}">
                                        {{ $project->title . "  " . '(' . $project->unique_id . ')'}} </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div id="main-holders">

                            <!-- Earning Box Start !-->
                            <div class="earning-holder">
                                <div class="delete-box">
                                    <span>حذف این مورد</span>
                                    <i class="fa fa-trash"></i>
                                </div>
                                <div style="height: 45px;"></div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">عنوان درآمد</label>
                                    <div class="col-md-10">
                                        <input type="text" required name="title[0]" class="form-control earning-title"
                                            placeholder="عنوان در آمد را وارد کنید ...">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">میزان درآمد</label>
                                    <div class="col-md-10">
                                        <input type="number" required name="received_money[0]" class="form-control earning-moeny"
                                            placeholder="میزان در آمد را وارد کنید ...">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">توضیحات</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control txt-custom earning-description" required
                                            placeholder="توضیحات در آمد را وارد کنید ..." name="description[0]"
                                            rows="3"></textarea>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">وضعیت</label>
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-paid" type="radio" name="status[0]" value="paid">

                                        <div class="state p-success">
                                            <label>پرداخت شده</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>


                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-unpaid" type="radio"  name="status[0]" 
                                            value="unpaid">

                                        <div class="state p-danger">
                                            <label>پرداخت نشده</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earning Box End !-->

                        </div>

                        <div class="form-group">
                            <button type="button" id="create-earning" class="btn btn-success waves-effect waves-light submit-button">
                                ثبت در آمد
                            </button>
                        </div>
                    </form>
                </div>




            </div>
        </div>
    </div>
</div>
@endsection
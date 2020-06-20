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

                        <div class="form-group">
                            <label class="col-md-2 control-label">پروژه</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="project">
                                    @foreach($projects as $project)
                                    <option price="{{ $project->price }}" value="{{ $project->id }}">
                                        {{ $project->title . "  " . '(' . $project->unique_id . ')'}} </option>
                                    @endforeach
                                </select>
                                @error('project')
                                <div class="alert alert-danger">{{ $description }}</div>
                                @enderror
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
                                        <input type="text" name="title[0]" class="form-control earning-title"
                                            value="{{ old('title') }}" placeholder="عنوان در آمد را وارد کنید ...">
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">میزان درآمد</label>
                                    <div class="col-md-10">
                                        <input type="number" name="received_money[0]" class="form-control earning-moeny"
                                            value="{{ old('received_money') }}"
                                            placeholder="میزان در آمد را وارد کنید ...">
                                        @error('received_money')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">توضیحات</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control txt-custom earning-description"
                                            placeholder="توضیحات در آمد را وارد کنید ..." name="description[0]"
                                            rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">وضعیت</label>
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-status" type="radio" name="status[0]" value="paid"
                                            checked />
                                        <div class="state p-success">
                                            <label>پرداخت شده</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                            <i class="icon mdi mdi-check"></i>
                                        </div>
                                    </div>


                                    <div class="pretty p-icon p-round p-pulse">
                                        <input class="earning-status" type="radio" name="status[0]" value="unpaid" />
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
                            <button type="submit" class="btn btn-success waves-effect waves-light submit-button">
                                ثبت در آمد
                            </button>
                        </div>
                    </form>
                </div><!-- end col -->




            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>
@endsection
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
                    <form class="form-horizontal" role="form" action="{{ route('costs.update', $cost->id) }}"
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
                                <input type="number" name="money_paid" class="form-control"
                                    value="{{ $cost->money_paid }}" placeholder="میزان هزینه را وارد کنید ...">
                                @error('money_paid')
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
                            <label class="col-md-2 control-label">نوع هزینه</label>
                            <div class="col-md-10">
                                <select class="form-control" name="type">
                                    <optgroup label="پیش فرض">
                                        <option value="0" @if($cost->type == null) {{ "selected" }} @endif>ندارد
                                        </option>
                                    </optgroup>
                                    @php $count = 0; @endphp
                                    @foreach($types as $type)
                                    @if($type->sub_cats->count() != 0)
                                    <optgroup label="{{ $type->title }} ">
                                        @foreach($type->sub_cats as $subCat)
                                        <option value="{{ $subCat->id }}" @if($cost->type == $subCat->id)
                                            {{ "selected" }} @endif >{{ $subCat->title }} </option>
                                        @endforeach
                                    </optgroup>
                                    @php $count += 1; @endphp
                                    @endif
                                    @endforeach

                                    @if($count == 0)
                                    <option disabled value="null">موردی برای نمایش وجود ندارد</option>
                                    @endif
                                </select>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if($costType == 'contract_pay' || $costType == 'contract_without_project')
                        @php $user = \App\User::where('id', $cost->contractor_id)->first(); @endphp
                        <div class="form-group">
                            <label class="col-md-2 control-label">نام کاربر</label>
                            <div class="col-md-10">
                                <select class="form-control" name="contractor_id" disabled>
                                    <option value="{{ $user->id}}">{{ $user->full_name}}</option>
                                </select>
                                @error('money_paid')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endif
                        @if($costType == 'contract_pay')



                        @php $project = \App\Project::where('id', $cost->project_id)->first(); @endphp
                        <div class="form-group">
                            <label class="col-md-2 control-label">پروژه</label>
                            <div class="col-md-10">
                                <select class="form-control" name="project_id" disabled>
                                    <option value="{{ $project->id}}">{{ $project->title}}</option>
                                </select>
                                @error('project_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        @endif


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
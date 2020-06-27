@extends('Contractor.Layout.main')
@section('title', 'پروفایل کاربری')
@section('header', 'مشخصات کاربری شما')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            <h4 class="header-title m-t-0 m-b-30">اطلاعات کاربری شما</h4>
            <div class="media m-b-20">
                <div class="media-left">
                    <a href="#"> <img class="media-object img-circle" alt="هزینه" src="/admin/images/user/default.png"
                            style="width: 48px; height: 48px; border:1px solid #ddd; vertical-align:-3px;"> </a>
                </div>
                <div class="media-body" style="border-bottom: 2px solid #337ab7; padding-bottom: 13px;">


                    <h4 class="media-heading m-b-0 ear-sta-text">وضعیت</h4>
                    <span class="label label-success earning-status-label">پرداخت شده</span>
                </div>
            </div>

            <div class="clear-fix"></div>
            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                نوع هزینه : 
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{ ""}}</h4>
            <div class="clear-fix"></div>

            <h4 class="font-600" style="display: inline-block;margin-left:5px; font-weight:bold; color:rgb(0, 0, 59);">
                عنوان هزینه : 
            </h4>
            <h4 class="font-600 m-b-20" style="display: inline-block;">{{""  }}</h4>

            <div class="clear-fix"></div>


            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>
                 
                    <h5 class="font-600 m-b-5">آخرین بروزرسانی</h5>
                    <p class="date-show">{{ ""}}</p>
                </li>

                <li>
                  
                    <h5 class="font-600 m-b-5">تاریخ ثبت هزینه</h5>
                    <p class="date-show">{{ "" }}</p>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
@endsection

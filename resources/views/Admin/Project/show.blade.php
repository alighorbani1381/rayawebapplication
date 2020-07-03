@extends('Admin.Layout.main')
@section('title', 'جزئیات پروژه')
@section('header', 'جزئیات پروژه')
@push('js')
<script src="{{ asset('admin/js/customJS/projects.js') }} "></script>
@endpush
@section('content')
<div class="row">

    <!-- Project Information Start !-->
    <div class="col-md-12">
        <div class="card-box">

            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                        aria-expanded="true">
                        <i class="fa fa-laptop i-fix"></i>
                        <span>اطلاعات کلی پروژه</span>
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#taskmaster" role="tab" id="taskmaster-tab" data-toggle="tab" aria-controls="taskmaster"
                        aria-expanded="false">
                        <i class="fa fa-user i-fix"></i>
                        <span>اطلاعات کارفرما</span>
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#contract" role="tab" id="contract-tab" data-toggle="tab" aria-controls="contract"
                        aria-expanded="false">
                        <i class="fa fa-newspaper-o i-fix"></i>
                        <span>اطلاعات قرارداد</span>
                    </a>
                </li>

                

                @php
                if($project['project']->status != 'waiting')
                $taskDivide = "true";
                else
                $taskDivide = "false";
                @endphp

                <li role="presentation" class="">
                    <a href="#contractors" role="tab" id="contractors-tab" data-toggle="tab" aria-controls="contractors"
                        aria-expanded="false" taskdivide="{{ $taskDivide }}">
                        <i class="fa fa-bar-chart-o i-fix"></i>
                        <span>وضعیت انجام پروژه</span>
                    </a>
                </li>

            </ul>

            <div class="tab-content">

                {{-- Home Tab --}}
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">

                    
                    @if($project['project']->status == 'ongoing')
                    @php

                    if($allProgress < 25) $color="danger" ; if($allProgress>= 25 && $allProgress < 50 ) $color="warning"
                            ; if($allProgress>= 50 && $allProgress < 75 ) $color="info" ; if($allProgress>= 75 &&
                                $allProgress <= 100 ) $color="success" ; @endphp <p class="font-600 m-b-5">
                                    وضعیت پیشرفت پروژه
                                    <span class="text-{{$color}} pull-right">{{ $allProgress }}%</span></p>
                                    <div class="progress progress-bar-{{$color}}-alt progress-md m-b-5">
                                        <div class="progress-bar progress-bar-{{$color}} progress-bar-striped progress-animated wow animated animated "
                                            role="progressbar" aria-valuenow="{{ $allProgress }}" aria-valuemin="0"
                                            aria-valuemax="100"
                                            style="width: {{ $allProgress }}%; visibility: visible; animation-name: animationProgress;">


                                        </div>
                                    </div>
                                    @else
                                    <div class="alert alert-danger war">
                                        <b>
                                            <i class="fa fa-warning"></i>&nbsp;
                                            هشدار:
                                        </b>
                                        <p>این پروژه غیر فعال است پس از تقسیم وظایف توسط مدیر برای پیمانکاران این
                                            پروژه درصد پیشرفت قابل مشاهده خواهد بود.</p>
                                    </div>
                                    <div class="alert alert-info war">
                                        <b><i class="fa fa-info-circle"></i>&nbsp;راهنمایی:</b>
                                        <p>برای فعالسازی پروژه و تقسیم وظایف در همین صفحه قسمت «تقسیم وظایف پیمانکاران»
                                            استفاده کنید.
                                        </p>
                                    </div>
                                    @endif


                                    <div class="clearfix"></div>
                    <div class="card-box items-box">
                        <h4 class="header-title">عنوان پروژه :</h4>
                        <b> {{ $project['project']->title }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">قیمت : </h4>
                        <b> {{ number_format($project['project']->price) . " تومان "}} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">شناسه پروژه : </h4>
                        <b> {{ $project['project']->unique_id }} </b>
                    </div>



                    @php
                    $paragraphs = explode('\n', $project['project']->description);
                    @endphp

                    <div class="card-box items-box">
                        <h4 class="header-title">توضیحات پروژه : </h4>

                        @foreach($paragraphs as $paragraph)
                        <p class="text-muted" style="text-align: justify;">
                            {{ $paragraph . "."}}
                        </p>
                        @endforeach
                    </div>

                    <div class="m-b-20"></div>



                </div>

                {{-- Home Tab --}}
                <div role="tabpanel" class="tab-pane fade" id="contract" aria-labelledby="contract-tab">
                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ شروع قرارداد :</h4>
                        <b class="date-show"> {{ verta($project['project']->contract_started)->formatJalaliDate() }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ پایان قرارداد :</h4>
                        <b class="date-show"> {{ verta($project['project']->contract_ended)->formatJalaliDate() }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تصویر قرار داد :</h4>
                        @if(strtolower($project['project']->contract_image) != 'default')
                        <a href="{{ showPicture('contract.image', $project['project']->contract_image) }}" target="_blank">
                            <img class="contract-image" src="{{ showPicture('contract.image', $project['project']->contract_image) }}" alt="تصویر قرارداد">
                        </a>
                        @else
                        <a href="{{ asset('admin/images/symbols/contract-image.png') }}" target="_blank">
                            <img class="contract-image" src="{{ asset('admin/images/symbols/contract-image.png') }}" alt="تصویر قرارداد">
                        </a>
                        @endif
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="taskmaster" aria-labelledby="taskmaster-tab">

                    <div class="card-box items-box">
                        <h4 class="header-title">نام و نام خانوادگی :</h4>
                        <b> {{ $project['project']->name . " " . $project['project']->lastname }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">نام پدر :</h4>
                        <b> {{ $project['project']->father_name }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">شماره تماس :</h4>
                        <b> {{ $project['project']->phone }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">آدرس :</h4>
                        <b class="jus"> {{ $project['project']->address }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">کد ملی :</h4>
                        <b> {{ $project['project']->meli_code }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تصویر کد ملی:</h4>
                        <a href="" target="_blank">
                            @if($project['project']->meli_image != 'default')
                            <img class="contract-image" src="{{ showPicture('meli.image', $project['project']->meli_image) }}"
                                alt="{{ $project['project']->name . " " . $project['project']->lastname }}">
                            @else
                            <img class="contract-image" src="{{ asset('admin/images/users/default.png') }}"
                                alt="{{ $project['project']->name . " " . $project['project']->lastname }}">
                            @endif
                            </b>
                    </div>


                </div>

                @if($project['project']->status != 'waiting')
                <div role="tabpanel" class="tab-pane fade" id="contractors" aria-labelledby="contractors-tab">
                    @foreach($project['contractors'] as $contractor)
                    @php
                    $fullName = $contractor->name . " " . $contractor->lastname;
                    $progress = $contractor->progress;
                    @endphp
                    <div class="card-box items-box">
                        <div style="margin-bottom:30px;">
                            <a href="#">
                                @if($contractor->profile != 'default')
                                <img class="media-object img-circle thumb-sm"
                                    style="display:inline-block; margin-left:8px;" alt="{{ $fullName }}"
                                    src="{{ showPicture('user.profile', $contractor->profile) }}"></a>
                            @else
                            <img class="media-object img-circle thumb-sm" style="display:inline-block; margin-left:8px;"
                                alt="{{ $fullName }}" src="{{ asset('admin/images/users/default.png') }}"></a>

                            @endif

                            <h4 class="header-title">نام پیمانکار : </h4>
                            <b>{{ $fullName }}</b>
                        </div>

                        <div style="margin-bottom:30px;">
                            <a href="#">
                                <img class="media-object img-circle thumb-sm"
                                    style="display:inline-block; margin-left:8px;" alt="{{ $fullName }}"
                                    src="{{ asset('admin/images/symbols/percent2.jpg') }}"></a>
                            <h4 class="header-title">درصد اختصاص یافته : </h4>
                            <b>{{ $contractor->progress_access . "%" }}</b>
                        </div>
                        @php
                        if( $progress < 25) $color="danger" ; if($progress>= 25 && $progress < 50 ) $color="warning" ;
                                if($progress>= 50 && $progress < 75 ) $color="info" ; if($progress>= 75 && $progress <=
                                        100 ) $color="success" ; @endphp <p class="font-600 m-b-5 text-{{$color}}">
                                        پیشرفت کار این پیمانکار
                                        <span class="text-{{$color}} pull-right">{{ $progress . "%"}}</span>
                                        </p>
                                        <div class="progress progress-bar-{{$color}}-alt progress-md m-b-5">
                                            <div class="progress-bar progress-bar-{{$color}} progress-bar-striped progress-animated wow animated animated "
                                                role="progressbar" aria-valuenow="{{ $contractor->progress}}"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ $contractor->progress}}%; visibility: visible; animation-name: animationProgress;">
                                            </div>
                                        </div>
                    </div>
                    @endforeach
                </div>
                @endif


            </div>
        </div>
    </div>
    <!-- Project Information End !-->


    @if($project['project']->status == 'waiting')
    <!-- Contractor Col Start   -->
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" id="auto-divide">
                            <i class="fa fa-spin fa-refresh" style="margin-left: 8px;"></i>
                            تقسیم بندی خودکار</a></li>
                </ul>
            </div>

            @php
            $count = $project['contractors']->count();
            $percent = round(100 / $count,0);
            $personPercent=[];
            for($i = 0; $i < $count; $i++){ $extra=100 - ($percent * $i); if($i==($count - 1)) $personPercent[]=$extra;
                else $personPercent[]=$percent; } @endphp <h4 class="header-title m-t-0 m-b-30">
                تقسیم وظایف پیمانکاران این پروژه
                ({{  $count . "نفر"}})
                </h4>

                <div>

                    @error('progress.*')
                    <div class="alert alert-danger">
                        <i class="fa fa-warning"></i>
                        اطلاعات وارد شده برای تقسیم وظایف نادرست می باشد.
                    </div>
                    @enderror

                    <form method="post" action="{{ route('projects.divide') }}">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project['project']->id }}">
                        @foreach($project['contractors'] as $key => $contractor)
                        <?php $contractorFullName = $contractor->name . " " . $contractor->lastname;?>
                        <div class="media m-b-10">
                            <div class="media-left">
                                <a href="#"> 
                                    @if($contractor->profile != 'default')                                    
                                    <img class="media-object img-circle thumb-sm" alt="{{ $contractorFullName }}" src="{{ showPicture('user.profile', $contractor->profile) }}"> 
                                    @else
                                    <img class="media-object img-circle thumb-sm" alt="{{ $contractorFullName }}" src="/admin/images/users/default.png"> 
                                    @endif
                                    </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $contractorFullName }}</h4>
                                <p class="font-13 text-muted m-b-0">
                                    <input type="hidden" value="{{ $contractor->contract_id }}"
                                        name="access[{{ $key }}]">
                                    <input class="progress-divide form-control input-sm"
                                        placeholder="درصد مشارکت این پیمانکار در پروژه را وارد کنید ..." type="number"
                                        max="100" name="progress[{{ $key }}]" value="{{ $personPercent[$key] }}">
                                </p>
                            </div>

                        </div>
                        @endforeach

                        <div class="media m-b-10">
                            <div class="media-left">
                                <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64"
                                        src="/admin/images/symbols/percent.jpg"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">مجموع درصد همکاری</h4>
                                <p class="font-13 text-muted m-b-0">
                                    <input class="form-control input-sm sucsok" type="number" value="100" disabled
                                        id="All-Percent">
                                </p>
                            </div>

                        </div>
                        <div class="media m-b-10">
                            <button type="button" id="divide-contractor"
                                class="btn btn-primary waves-effect submit-button">
                                تقسیم وظایف و فعالسازی پروژه
                            </button>

                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- Contractor Col End -->
    @endif

   
    <!-- Pay List col Start -->
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('earnings.pay', $project['project']->id) }}"><i class="fa fa-plus"></i> &nbsp;
                            افزودن</a>
                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                در آمد های ثبت شده
                @if( $project['earnings']->count() > 0)
                ({{ $project['earnings']->count() . "مورد"}})
                @endif
            </h4>

            <div>
                @if( $project['earnings']->count() > 0)
                @foreach($project['earnings'] as $key => $earning)
                <div class="media m-b-10 earning-box">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="{{ $earning->title }}"
                                src="/admin/images/symbols/rial.png" style="border: 1px solid #ddd;"> </a>

                    </div>
                    <div class="media-body">
                        <h4 class="media-heading" style="margin-bottom: 12px; margin-top:4px;">{{ $earning->title }}
                        </h4>
                        <p class="font-13 text-muted m-b-0" style="display: block; text-align:right;">
                            <span>تاریخ ثبت:</span>
                            <time dir="ltr"
                                class="date-show">{{ verta($earning->created_at)->format('Y/n/j H:i') }}</time>
                        </p>
                        <div class="date-show earning-time" style="margin: 12px 0;">
                            <span>میزان درآمد:</span>
                            <span
                                style="font-weight: bold;">{{ number_format($earning->received_money) . " تومان " }}</span>
                        </div>
                        <div>
                            <span>وضعیت:</span>
                            @if($earning->status == 'paid')
                            <button class="btn btn-success waves-effect waves-light btn-sm m-b-5">پرداخت شده</button>
                            @else
                            <button class="btn btn-danger waves-effect waves-light btn-sm m-b-5">پرداخت نشده</button>
                            @endif
                        </div>
                        <a href="{{ route('earnings.show', $earning->id)}}"
                            class="btn btn-purple waves-effect submit-button">
                            <i class="fa fa-eye"></i> &nbsp;
                            مشاهده
                        </a>
                    </div>

                </div>
                @endforeach
                @else
                <div class="alert alert-warning">
                    <i class="fa fa-info-circle"></i>&nbsp;
                    هنوز درآمدی برای این پروژه ثبت نشده است.
                </div>

                <div class="alert alert-info">
                    <i class="fa fa-info"></i>&nbsp;
                    <strong>راهنمایی:</strong>
                    با استفاده از دکمه افزودن در منوی همین باکس درآمد خود را برای این پروژه ثبت کنید .
                </div>

                @endif

            </div>
        </div>
    </div>
    <!-- Pay list col End -->

    <!-- Cost List col Start -->
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('costs.create') }}"><i class="fa fa-plus"></i> &nbsp;
                            ثبت هزینه
                        </a>
                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                هزینه های پایه
                @if( $project['base_costs']->count() > 0)
                ({{ $project['base_costs']->count() . "مورد"}})
                @endif
            </h4>

            <div>
                @if( $project['base_costs']->count() > 0)
                @foreach($project['base_costs'] as $key => $cost)
                <div class="media m-b-10 earning-box">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="{{ $cost->title }}"
                                src="/admin/images/symbols/rial.png" style="border: 1px solid #ddd;"> </a>

                    </div>
                    <div class="media-body">
                        <h4 class="media-heading" style="margin-bottom: 12px; margin-top:4px;">{{ $cost->title }}</h4>

                        <div class="date-show earning-time" style="margin: 12px 0;">
                            <span>نوع هزینه:</span>
                            <span style="font-weight: bold;">{{ $cost->type_title}}</span>
                        </div>

                        <p class="font-13 text-muted m-b-0" style="display: block; text-align:right;">
                            <span>تاریخ ثبت:</span>
                            <time dir="ltr" class="date-show">{{ verta($cost->created_at)->format('Y/n/j H:i') }}</time>
                        </p>
                        <div class="date-show earning-time" style="margin: 12px 0;">
                            <span>میزان هزینه:</span>
                            <span style="font-weight: bold;">{{ number_format($cost->money_paid) . " تومان " }}</span>
                        </div>


                        <div>
                            <span>وضعیت:</span>
                            @if($cost->status == 'paid')
                            <button class="btn btn-success waves-effect waves-light btn-sm m-b-5">پرداخت شده</button>
                            @else
                            <button class="btn btn-danger waves-effect waves-light btn-sm m-b-5">پرداخت نشده</button>
                            @endif
                        </div>
                        <a href="{{ route('costs.show', $cost->id)}}" class="btn btn-purple waves-effect submit-button">
                            <i class="fa fa-eye"></i> &nbsp;
                            مشاهده
                        </a>
                    </div>

                </div>
                @endforeach
                @else
                <div class="alert alert-warning">
                    <i class="fa fa-info-circle"></i>&nbsp;
                    هنوز هزینه پایه ای برای این پروژه ثبت نشده است.
                </div>

                <div class="alert alert-info">
                    <i class="fa fa-info"></i>&nbsp;
                    <strong>راهنمایی:</strong>
                    با استفاده از دکمه افزودن در منوی همین باکس هزینه خود را برای این پروژه ثبت کنید .
                </div>

                @endif

            </div>
        </div>
    </div>
    <!-- Cost list col End -->


    <!-- Contractor Pay List col Start -->
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('costs.create') }}"><i class="fa fa-plus"></i> &nbsp;
                            ثبت هزینه
                        </a>
                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                هزینه های انجام پروژه
                @if( $project['contractor_costs']->count() > 0)
                ({{ $project['contractor_costs']->count() . "مورد"}})
                @endif
            </h4>

            <div>
                @if( $project['contractor_costs']->count() > 0)
                @foreach($project['contractor_costs'] as $key => $cost)
                <div class="media m-b-10 earning-box">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="{{ $cost->title }}"
                                src="/admin/images/symbols/rial.png" style="border: 1px solid #ddd;"> </a>

                    </div>
                    <div class="media-body">
                        <h4 class="media-heading" style="margin-bottom: 12px; margin-top:4px;">{{ $cost->title }}</h4>

                        <div class="date-show earning-time" style="margin: 12px 0;">
                            <span>پرداخت شده به :</span>
                            <span style="font-weight: bold;">{{ $cost->name . " " . $cost->lastname }}</span>
                        </div>

                        <div class="date-show earning-time" style="margin: 12px 0;">
                            <span>نوع هزینه:</span>
                            <span style="font-weight: bold;">{{ $cost->type_title}}</span>
                        </div>

                        <p class="font-13 text-muted m-b-0" style="display: block; text-align:right;">
                            <span>تاریخ ثبت:</span>
                            <time dir="ltr" class="date-show">{{ verta($cost->created_at)->format('Y/n/j H:i') }}</time>
                        </p>
                        <div class="date-show earning-time" style="margin: 12px 0;">
                            <span>میزان هزینه:</span>
                            <span style="font-weight: bold;">{{ number_format($cost->money_paid) . " تومان " }}</span>
                        </div>


                        <div>
                            <span>وضعیت:</span>
                            @if($cost->status == 'paid')
                            <button class="btn btn-success waves-effect waves-light btn-sm m-b-5">پرداخت شده</button>
                            @else
                            <button class="btn btn-danger waves-effect waves-light btn-sm m-b-5">پرداخت نشده</button>
                            @endif
                        </div>
                        <a href="{{ route('costs.show', $cost->id)}}" class="btn btn-purple waves-effect submit-button">
                            <i class="fa fa-eye"></i> &nbsp;
                            مشاهده
                        </a>
                    </div>

                </div>
                @endforeach
                @else
                <div class="alert alert-warning">
                    <i class="fa fa-info-circle"></i>&nbsp;
                    هنوز هزینه ای بابت انجام پروژه پرداخت نشده است.
                </div>

                <div class="alert alert-info">
                    <i class="fa fa-info"></i>&nbsp;
                    <strong>راهنمایی:</strong>
                    با استفاده از دکمه افزودن در منوی همین باکس هزینه خود را برای این پروژه ثبت کنید .
                </div>

                @endif

            </div>
        </div>
    </div>
    <!-- Contractor Pay  list col End -->

     <!-- Category col Start -->
     <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> &nbsp;افزودن خدمت جدید</a>
                    </li>

                    <li><a href="{{ route('categories.index') }}"><i class="fa fa-list-ul"></i> &nbsp;لیست خدمات</a>
                    </li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                خدمات به کار گرفته شده
                ({{ $project['categories']->count() . "مورد"}})
            </h4>

            <div>
                @foreach($project['categories'] as $key => $category)
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="{{ $category->title }}"
                                src="/admin/images/symbols/contract.png"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $category->title }}</h4>
                        <p class="font-13 text-muted m-b-0">
                            {{ $category->title }}
                        </p>
                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Category col End -->



</div>

@if(session()->has('ActiveProject'))
<script>
    maxMbox("پروژه فعال شد☕ ", "الان میتونید کار رو به پیمانکارانتون بسپارید و از همین پنل قسمت وضعیت انجام پروژه علمکرد آن ها را مدیریت کنید. .", "success", "ممنون", 500);
</script>
@endif
@endsection
@extends('Admin.Layout.main')
@section('title', 'جزئیات پروژه')
@section('header', 'جزئیات پروژه')
@push('js')
<script src="{{ asset('admin/js/customJS/projects.js') }} "></script>
@endpush
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card-box">

            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                        aria-expanded="true">اطلاعات کلی پروژه</a>
                </li>
                <li role="presentation" class="">
                    <a href="#contract" role="tab" id="contract-tab" data-toggle="tab" aria-controls="contract"
                        aria-expanded="false">اطلاعات قرارداد</a>
                </li>
                <li role="presentation" class="">
                    <a href="#taskmaster" role="tab" id="taskmaster-tab" data-toggle="tab" aria-controls="taskmaster"
                        aria-expanded="false">اطلاعات کارفرما</a>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"
                        aria-controls="myTabDrop1-contents" aria-expanded="false">
                        باز شونده <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                        <li>
                            <a href="#dropdown1" role="tab" id="dropdown1-tab" data-toggle="tab"
                                aria-controls="dropdown1">متن 1</a>
                        </li>
                        <li>
                            <a href="#dropdown2" role="tab" id="dropdown2-tab" data-toggle="tab"
                                aria-controls="dropdown2">متن 2</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="tab-content">

                {{-- Home Tab --}}
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">

                    <div class="card-box items-box">
                        <h4 class="header-title">عنوان پروژه:</h4>
                        <b> {{ $project['project']->title }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">قیمت:</h4>
                        <b> {{ number_format($project['project']->price) }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">شناسه پروژه:</h4>
                        <b> {{ $project['project']->unique_id }} </b>
                    </div>



                    @php
                    $paragraphs = explode('\n', $project['project']->description);
                    @endphp

                    <div class="card-box items-box">
                        <h4 class="header-title">توضیحات پروژه:</h4>

                        @foreach($paragraphs as $paragraph)
                        <p class="text-muted" style="text-align: justify;">
                            {{ $paragraph . "."}}
                        </p>
                        @endforeach
                    </div>

                    <div class="m-b-20"></div>

                    @if($project['contractors'][0]->progress_access != null)
                    <p class="font-600 m-b-5">پیشرفت کار <span class="text-success pull-right">80%</span></p>
                    <div class="progress progress-bar-success-alt progress-md m-b-5">
                        <div class="progress-bar progress-bar-success progress-bar-striped progress-animated wow animated animated "
                            role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                            style="width: 80%; visibility: visible; animation-name: animationProgress;">
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning war">
                        <b>
                            <i class="fa fa-warning"></i>&nbsp;
                            هشدار:
                        </b>
                        <p>این پروژه در انتظار اجرا است (غیر فعال است) پس از تقسیم وظایف توسط مدیر برای پیمانکاران این
                            پروژه درصد پیشرفت قابل مشاهده خواهد بود.</p>
                    </div>
                    <div class="alert alert-info war">
                        <b><i class="fa fa-info-circle"></i>&nbsp;راهنمایی:</b>
                        <p>برای فعالسازی پروژه و تقسیم وظایف از سمت چپ همین صفحه قسمت پیمانکاران استفاده کنید.</p>
                    </div>
                    @endif


                    <div class="clearfix"></div>


                </div>

                {{-- Home Tab --}}
                <div role="tabpanel" class="tab-pane fade" id="contract" aria-labelledby="contract-tab">
                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ شروع قرارداد :</h4>
                        <b> {{ $project['project']->contract_started }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ پایان قرارداد :</h4>
                        <b> {{ $project['project']->contract_ended }} </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تصویر قرار داد :</h4>
                        <b>
                            <img class="media-object thumb-sm" src="/admin/images/users/avatar-1.jpg" alt="">
                        </b>
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
                        <b>
                            <img src="{{ $project['project']->meli_code }}"
                                alt="{{ $project['project']->name . " " . $project['project']->lastname }}">
                        </b>
                    </div>


                </div>

                <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">

                </div>

                <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">

                </div>
            </div>
        </div>
    </div>


    <!-- Contractor Col Start   -->
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('users.create') }}">افزودن کاربر</a></li>
                    <li><a href="#">افزودن پیمانکار</a></li>
                </ul>
            </div>

            @php
            $count = $project['contractors']->count();
            $percent = round(100 / $count,0);
            $personPercent=[];
            for($i = 0; $i < $count; $i++){
                $extra = 100 - ($percent * $i);

                if($i == ($count - 1))
                    $personPercent[] = $extra;
                else
                    $personPercent[] = $percent;
            }            
            @endphp
            <h4 class="header-title m-t-0 m-b-30">
                پیمانکاران این پروژه
                ({{  $count . "نفر"}})
            </h4>

            <div>
                @foreach($project['contractors'] as $key => $contractor)
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64"
                                src="/admin/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $contractor->name . " " . $contractor->lastname }}</h4>
                        <p class="font-13 text-muted m-b-0">
                            <input type="hidden" value="{{ $contractor->id }}" name="access[{{ $key }}]">
                            <input class="progress-divide form-control input-sm"
                                placeholder="درصد مشارکت این پیمانکار در پروژه را وارد کنید ..." type="number" max="100"
                                name="progress[{{ $key }}]"  value="{{ $personPercent[$key] }}">
                        </p>
                    </div>

                </div>
                @endforeach

                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64"
                                src="/admin/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">مجموع درصد همکاری</h4>
                        <p class="font-13 text-muted m-b-0">
                            <input class="form-control input-sm sucsok" type="number" value="100" disabled id="All-Percent">
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Contractor Col End -->

    <!-- Category col Start -->
    <div class="col-md-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">متن یک</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">
                خدمات به کار گرفته در این پروژه
                ({{ $project['categories']->count() . "مورد"}})
            </h4>

            <div>
                @foreach($project['categories'] as $key => $category)
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64"
                                src="/admin/images/users/avatar-1.jpg"> </a>
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


@endsection
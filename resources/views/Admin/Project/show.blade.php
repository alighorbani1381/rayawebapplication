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

                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">



                    <h4 class="font-600 m-b-20">{{ $project['project']->title }}</h4>

                    @php
                    $paragraphs = explode('\n', $project['project']->description);
                    @endphp

                    @foreach($paragraphs as $paragraph)
                    <p class="text-muted" style="text-align: justify;">
                        {{ $paragraph . "."}}
                    </p>
                    @endforeach

                    <div class="m-b-20"></div>
                    @php
                   // dd($project);
                    @endphp
                    @if($project['contractors'][0]->progress_access != null)
                        <p class="font-600 m-b-5">پیشرفت کار <span class="text-success pull-right">80%</span></p>
                        <div class="progress progress-bar-success-alt progress-md m-b-5">
                            <div class="progress-bar progress-bar-success progress-bar-striped progress-animated wow animated animated "
                                role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                style="width: 80%; visibility: visible; animation-name: animationProgress;">
                            </div>
                        </div>                    
                    @else
                        <p class="font-600 m-b-5">پیشرفت کار <span class="text-success pull-right">0%</span></p>
                            <div class="progress progress-bar-success-alt progress-md m-b-5">
                                <div class="progress-bar progress-bar-success progress-bar-striped progress-animated wow animated animated "
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 0; visibility: visible; animation-name: animationProgress;">
                                </div>
                            </div>                    
                    @endif


                    <div class="clearfix"></div>


                </div>


                <div role="tabpanel" class="tab-pane fade" id="contract" aria-labelledby="contract-tab">
                    <h4 class="header-title m-b-30">درآمد کل</h4>
                    <ul class="list-inline task-dates m-b-0 m-t-20">

                        <li>
                            <h5 class="font-600 m-b-5">تاریخ اتمام قرارداد</h5>
                            <p> {{ $project['project']->contract_ended }} </p>
                        </li>

                        <li>
                            <h5 class="font-600 m-b-5">تاریخ شروع قرارداد</h5>
                            <p> {{ $project['project']->contract_started }} </p>
                        </li>


                        <li>
                            <h5 class="font-600 m-b-5">تصویر قرارداد</h5>
                            <img class="media-object thumb-sm" src="/admin/images/users/avatar-1.jpg" alt="">
                        </li>

                    </ul>
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

            <h4 class="header-title m-t-0 m-b-30">
                پیمانکاران این پروژه 
                ({{  $project['contractors']->count() . "نفر"}})
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
                            <input class="form-control input-sm"
                                placeholder="درصد مشارکت این پیمانکار در پروژه را وارد کنید ..." type="number" max="100"
                                name="progress[{{ $key }}]" id="progress">
                        </p>
                    </div>

                </div>
                @endforeach

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
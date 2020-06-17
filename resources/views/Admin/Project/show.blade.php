@extends('Admin.Layout.main')
@section('title', 'جزئیات پروژه')
@section('header', 'جزئیات پروژه')
@push('js')
<script src="{{ asset('admin/js/customJS/projects.js') }} "></script>
@endpush
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">متن یک</a></li>
                    <li class="divider"></li>
                    <li><a href="#">متن پا ورقی</a></li>
                </ul>
            </div>

            <h4 class="font-600 m-b-20">{{ $proj->title }}</h4>

            @php
                $paragraphs = explode('\n', $proj->description);    
            @endphp

            @foreach($paragraphs as $paragraph)
                <p class="text-muted">
                    {{ $paragraph . "."}}
                </p>
            @endforeach

            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>
                    تاریخ ها
                </li>
                <li class="divider"></li>
                <li>
                    <h5 class="font-600 m-b-5">2</h5>
                    <p> {{ $proj->date_start }} </p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">1</h5>
                    <p> {{ $proj->date_start }} </p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">اتمام پس از (روز)</h5>
                    <p> {{ $proj->complete_after . " روز "}}</p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">قیمت پروژه (تومان)</h5>
                    <p> {{ number_format($proj->price) }}</p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">6</h5>
                    <p> {{ $proj->date_start }} </p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">5</h5>
                    <p> {{ $proj->date_start }} </p>
                </li>

            </ul>
            <div class="clearfix"></div>

           
        </div>
    </div><!-- end col -->

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
                 پیمانکاران  
            ({{ $contractors->count() }}) 
            </h4>

            <div>
                @foreach($contractors as $key => $contractor)
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="/admin/images/users/avatar-1.jpg"> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $contractor->name . " " . $contractor->lastname }}</h4>
                        <p class="font-13 text-muted m-b-0">
                            <input type="hidden" value="{{ $contractor->id }}" name="access[{{ $key }}]">
                            <input class="form-control input-sm" placeholder="درصد مشارکت این پیمانکار در پروژه را وارد کنید ..." type="number" max="100" name="progress[{{ $key }}]" id="progress">
                        </p>
                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </div><!-- end col -->

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
                 خدمات
            ({{ $categories->count() }}) 
            </h4>

            <div>
                @foreach($categories as $key => $category)
                <div class="media m-b-10">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle thumb-sm" alt="64x64" src="/admin/images/users/avatar-1.jpg"> </a>
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
    </div><!-- end col -->
    
</div>
@endsection
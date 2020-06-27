@extends('Contractor.Layout.main')
@section('title', 'جزئیات پروژه')
@section('header', 'جزئیات پروژه')
@section('content')
<div class="row">

    <!-- Project Information Start !-->
    <div class="col-md-12">
        <div class="card-box">

            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                        aria-expanded="true">اطلاعات کلی پروژه</a>
                </li>

                <li role="presentation" class="">
                    <a href="#contract" role="tab" id="contract-tab" data-toggle="tab" aria-controls="contract"
                        aria-expanded="false">اطلاعات مربوط به زمان انجام پروژه</a>
                </li>
            </ul>

            <div class="tab-content">

                {{-- Global Information Project Tab --}}
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                    <div class="clearfix"></div>

                    <div class="card-box items-box">
                        <h4 class="header-title">عنوان پروژه :</h4>
                        <b> {{ $project['project']->title }} </b>
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

                {{-- Project Work Status Tab --}}
                <div role="tabpanel" class="tab-pane fade" id="contract" aria-labelledby="contract-tab">

                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ شروع قرارداد :</h4>
                        <b class="date-show"> {{ verta($project['project']->contract_started)->formatJalaliDate() }}
                        </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ شروع کار :</h4>
                        <b class="date-show"> {{ verta($project['project']->date_start)->formatJalaliDate() }}
                        </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">مهلت انجام پروژه :</h4>
                        <b class="date-show"> {{ $project['project']->complete_after . " روز "}}
                        </b>
                    </div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تاریخ تحویل پروژه :</h4>
                        @php
                        $daysAfter = $project['project']->complete_after;
                        $dateFinish = verta($project['project']->date_start)->addDays($daysAfter);
                        @endphp
                        <b class="date-show"> {{ $dateFinish->formatJalaliDate() }}
                        </b>
                    </div>

                    <?php
                    $dayLefts = verta()->diffDays($dateFinish);
                    $pastDate = $dateFinish->formatDifference(verta());
                    $percentLeft = ($dayLefts * 100) / $daysAfter;
                    $color = "";
                    if($percentLeft < 25) $color="danger"; 
                    if($percentLeft>= 25 && $percentLeft < 50 ) $color="warning"; 
                    if($percentLeft>= 50 && $percentLeft < 75 ) $color="info";
                    if($percentLeft>= 75 && $percentLeft <= 100 ) $color="success";     

                    
                    ?>

                    @if($percentLeft < 100) <div class="card-box items-box">
                        <h4 class="header-title">تعداد روز های باقی مانده تا تحویل :</h4>

                        @if($dayLefts <= 0) <b class="date-show">
                            <span style="margin-left:10px; color:rgb(158, 12, 12);">زمان انجام این پروژه به پایان رسیده
                                است !</span>

                            <span style="color:rgb(223, 160, 25);">
                                زمان تحویل این پروژه
                                {{ $pastDate }}
                                بوده است
                                .
                            </span>

                            </b>
                            @else
                            <b class="date-show"> {{ $dayLefts . " روز "}}</b>
                            @endif
                </div>
                @endif


                @if($percentLeft < 100) <span class="header-title">روز های باقی مانده بر حسب درصد</span>
                    <div class="card-box items-box">
                        <span class="text-{{$color}} pull-right">{{ $percentLeft }}%</span></p>
                        <div class="progress progress-bar-{{$color}}-alt progress-md m-b-5">
                            <div class="progress-bar progress-bar-{{$color}} progress-bar-striped progress-animated wow animated animated "
                                role="progressbar" aria-valuenow="{{ $percentLeft }}" aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: {{ $percentLeft }}%; visibility: visible; animation-name: animationProgress;">
                            </div>
                        </div>
                        @else
                        <div class="card-box items-box" style="background: #ffc800;color: black;">
                            <span class="header-title" style="display:inline-block; margin-bottom:10px;">نکته
                                مهم:</span>

                            <b class="date-show">
                                <?php $dateStart = verta($project['project']->date_start)?>
                                این پروژه
                                <span style="font-size:large; color:#e01c1c;">
                                    {{ $dateStart->formatDifference() . " "}}
                                </span>
                                برای شما فعال می شود.

                            </b>


                        </div>
                        @endif

                    </div>




            </div>
        </div>
    </div>
    <!-- Project Information End !-->


</div>

@if(session()->has('ActiveProject'))
<script>
    maxMbox("پروژه فعال شد☕ ", "الان میتونید کار رو به پیمانکارانتون بسپارید و از همین پنل قسمت وضعیت انجام پروژه علمکرد آن ها را مدیریت کنید. .", "success", "ممنون", 500);
</script>
@endif
@endsection
@extends('Contractor.Layout.main')
@section('title', 'جزئیات پروژه')
@section('header', 'جزئیات پروژه')
@section('content')
<div class="row">

    <!-- Project Information Start !-->
    <div class="col-md-12">
        <div class="card-box">

            <!-- Main Menu Start !-->
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                        aria-expanded="true">
                        <i class="fa fa-info-circle i-fix"></i>
                        <span>اطلاعات کلی پروژه</span>
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#contract" role="tab" id="contract-tab" data-toggle="tab" aria-controls="contract"
                        aria-expanded="false">
                        <i class="fa fa-clock-o i-fix"></i>
                        <span>اطلاعات مربوط به زمان انجام پروژه</span>
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#statistic" role="tab" id="statistic-tab" data-toggle="tab" aria-controls="statistic"
                        aria-expanded="false">
                        <i class="fa fa-bar-chart-o i-fix"></i>
                        <span>آمار مربوط به انجام پروژه</span>
                    </a>
                </li>
            </ul>
            <!-- Main Menu End !-->

            <!-- Tabs Start !-->
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

                <div role="tabpanel" class="tab-pane fade in" id="statistic" aria-labelledby="statistic-tab">
                    <div class="clearfix"></div>

                    <div class="card-box items-box">
                        <h4 class="header-title">تعداد مشارکت کننده ها :</h4>
                        <b> {{ $project['contractors']->count() . " نفر " }} </b>
                    </div>

                    <div class="card-box items-box">
                        <div class="project-members m-b-20">
                            <h4 class="header-title">مشارکت کننده های پروژه :</h4>

                            @foreach($project['contractors'] as $contractor)
                            <a href="#" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="@if($contractor->id != auth()->user()->id){{ $contractor->name . ' ' . $contractor->lastname }}@else{{"شما"}}@endif">
                                @if($contractor->profile != 'default')
                                <img src="{{ showPicture('user.profile', $contractor->profile) }}"
                                    class="img-circle thumb-sm" alt="friend">
                                @else
                                <img src="/admin/images/users/default.png" class="img-circle thumb-sm" alt="friend">
                                @endif
                            </a>
                            @endforeach

                        </div>
                    </div>

                    <?php
                    if( $allProgress < 25) $color="danger" ; 
                    if($allProgress>= 25 && $allProgress < 50 ) $color="warning" ;
                    if($allProgress>= 50 && $allProgress < 75 ) $color="info" ; 
                    if($allProgress>= 75 && $allProgress <= 100 ) $color="success";
                     ?>

                    <div class="card-box items-box">
                        <span class="header-title">درصد پیشرفت کل پروژه</span>
                        <span class="text-{{$color}} pull-right">{{$allProgress}}%</span></p>
                        <div class="progress progress-bar-{{$color}}-alt progress-md m-b-5">
                            <div class="progress-bar progress-bar-{{$color}} progress-bar-striped progress-animated wow animated animated "
                                role="progressbar" aria-valuenow="{{$allProgress}}" aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: {{$allProgress}}%; visibility: visible; animation-name: animationProgress;">
                            </div>
                        </div>
                    </div>


                    <?php
                    $selfProgress = $progressInfo->progress;
                    if( $selfProgress < 25) $color="danger" ; 
                    if($selfProgress>= 25 && $selfProgress < 50 ) $color="warning" ;
                    if($selfProgress>= 50 && $selfProgress < 75 ) $color="info" ; 
                    if($selfProgress>= 75 && $selfProgress <= 100 ) $color="success";
                     ?>

                    <div class="card-box items-box">
                        <span class="header-title">درصد پیشرفت شما</span>
                        <span class="text-{{$color}} pull-right">{{$selfProgress}}%</span></p>
                        <div class="progress progress-bar-{{$color}}-alt progress-md m-b-5">
                            <div class="progress-bar progress-bar-{{$color}} progress-bar-striped progress-animated wow animated animated "
                                role="progressbar" aria-valuenow="{{$selfProgress}}" aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: {{$selfProgress}}%; visibility: visible; animation-name: animationProgress;">
                            </div>
                        </div>
                    </div>
                    @if($allProgress != 100)
                    <div class="card-box items-box" style="position: relative; visibility: hidden;">
                        <a href="{{ route('contractor.projects.show.progress', $project['project']->id) }}"
                            class="btn btn-success waves-effect submit-button" style="position: absolute; display:block !important; margin-left:0; left:10px; visibility: visible;">
                            
                            <span>ویرایش میزان پیشرفت پروژه</span>
                            <i class="fa fa-pencil m-l-5"></i>
                        </a>
                    </div>
                    @endif
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
            <!-- Tabs End !-->

        </div>
    </div>
    <!-- Project Information End !-->


</div>



@if(session()->has('dont-start'))
<style>
    .swal2-popup {
        width: 40%;
    }
</style>

<script>
    var title = "زمان شروع کار برای این پروژه هنوز نرسیده" + " « " +  "{{ Session::get('dont-start') }}" + " » " ;
    var message = "در همین صفحه از قسمت اطلاعات مربوط به انجام پروژه اطلاعات دقیق راجب زمان شروع پروژه به دست میارید";
    var btn = "آها گرفتم";
    maxMbox(title, message, "warning", btn, 100);
</script>
@endif
@endsection
@extends('Contractor.Layout.main')
@section('title', 'لیست پروژه های فعال')
@section('header', 'پروژه های در دست اجرا')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            
            @if(hasMember($projects))
            <h4 class="header-title m-t-0 m-b-30 inb">
                <i class="fa fa-keyboard-o i-fix"></i>
                <span>لیست پروژه های در دست اجرا</span>
            </h4>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="tac">ردیف</th>
                        <th>ایجاد شده توسط</th>
                        <th>عنوان پروژه</th>
                        <th>توضیحات پروژه (خلاصه)</th>
                        <th class="tac">تاریخ ثبت</th>
                        <th class="tac">تاریخ شروع</th>
                        <th class="tac">مدت زمان تحویل </th>
                        <th class="tac">تاریخ تحویل</th>
                        <th class="tac">مشاهده جزئیات</th>
                        <th class="tac">ویرایش درصد پیشرفت</th>
                        <th class="tac">میزان درآمد شما</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projects as $row => $project)
                    <?php $projectStart = verta($project->date_start);?>
                    <tr>
                        <td class="tac"><?= $row  + 1 ?></td>
                        <td>{{ $project->name . " " . $project->lastname }}</td>
                        <td class="projectName">{{ $project->title }}</td>
                        <td>{{ mb_substr($project->description,0 , 80) . "..." }}</td>
                        <td class="tac">{{ verta($project->created_at)->formatJalaliDate() }}</td>
                        <td class="tac">{{ $projectStart->formatJalaliDate() }}</td>
                        <td class="tac">{{ $project->complete_after . " روز " }}</td>
                        <td class="tac">{{ $projectStart->addDays($project->complete_after)->formatJalaliDate() }}</td>
                        <td class="tac">
                            <a href="{{ route('contractor.projects.show', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                                <i class="fa fa-file-text-o"></i>
                            </a>
                        </td>


                        <td class="tac">
                            <a href="{{ route('contractor.projects.show.progress', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                    class="fa fa-pencil"></i> </a>
                        </td>
                        <td class="tac">
                            <a href="{{ route('contractor.earning.project', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-success m-b-5"> <i
                                    class="fa fa-money"></i> </a>
                        </td>

                    </tr>
  
                    @endforeach

                </tbody>
            </table>
            @else
            {!! recordMessage('پروژه ی در حال اجرایی وجود ندارد.') !!}
            @endif
            {{ $projects->links() }}
        </div>
    </div><!-- end col -->
</div>


@if(session()->has('ProgressChange'))
<script id="test">
    var message = "درصد پیشرفت پروژه با موفقیت بروزرسانی شد.";
    minMbox(message, 350);
</script>
    <?php session()->forget('ProgressChange'); ?>
@endif


@endsection
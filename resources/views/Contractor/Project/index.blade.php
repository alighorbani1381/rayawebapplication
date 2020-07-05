@extends('Contractor.Layout.main')
@section('title', 'لیست پروژه های شما')
@section('header', 'پروژه های شما')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            @if(hasMember($projects))
            <h4 class="header-title m-t-0 m-b-30 inb">
                لیست پروژه ها
            </h4>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>ایجاد شده توسط</th>
                        <th>عنوان پروژه</th>
                        <th>توضیحات پروژه (خلاصه)</th>
                        <th>شناسه پروژه</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">مشاهده جزئیات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projects as $row => $project)
                    <tr>
                        <td><?= $row  + 1 ?></td>
                        <td>{{ $project->name . " " . $project->lastname }}</td>
                        <td class="projectName">{{ $project->title }}</td>
                        <td>{{ mb_substr($project->description,0 , 80) . "..." }}</td>
                        <td>{{ $project->unique_id }}</td>

                        <td class="tac">
                            @if ($project->status == 'waiting')
                            <button type="button"
                                class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">غیر فعال</button>
                            @endif

                            @if ($project->status == 'ongoing')
                            <button type="button"
                                class="tac btn btn-warning btn-rounded w-md waves-effect waves-light m-b-5">در حال
                                اجرا</button>
                            @endif

                            @if ($project->status == 'finished')
                            <button type="button"
                                class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">پایان
                                یافته</button>
                            @endif
                        </td>

                        <td class="tac">
                            <a href="{{ route('contractor.projects.show', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                                <i class="fa fa-file-text-o"></i>
                            </a>
                        </td>

                    </tr>
 
                    @endforeach

                </tbody>
            </table>
            @else
            {!! recordMessage('برای شما تا کنون پروژه ای ثبت نشده است.') !!}
            @endif
            {{ $projects->links() }}
        </div>
    </div><!-- end col -->
</div>


@if(Session::has('ProgressChange'))
<script id="test">
    var message = "درصد پیشرفت پروژه با موفقیت بروزرسانی شد.";
    minMbox(message, 350);
</script>
@endif
<?php Session::forget('ProgressChange'); ?>


@endsection
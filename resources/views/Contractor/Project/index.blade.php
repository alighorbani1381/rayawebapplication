@extends('Contractor.Layout.main')
@section('title', 'لیست پروژه های شما')
@section('header', 'پروژه های شما')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="header-title m-t-0 m-b-30 inb">
                لیست پروژه ها
            </h4>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان پروژه</th>
                        <th>توضیحات پروژه (خلاصه)</th>
                        <th>شناسه پروژه</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">مشاهده جزئیات</th>
                        <th class="tac">ویرایش درصد پیشرفت</th>
                        <th class="tac">میزان درآمد شما</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($projects as $row => $project)
                    <tr>
                        <td><?= $row  + 1 ?></td>
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


                        <td class="tac">
                            <a href="{{ route('contractor.projects.show.progress', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                    class="fa fa-pencil"></i> </a>
                        </td>
                        <td class="tac">
                            <a href="{{ route('earnings.pay', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-success m-b-5"> <i
                                    class="fa fa-money"></i> </a>
                        </td>

                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        <i class="fa fa-warning"></i> 
                        <span>برای شما تا کنون پروژه ای ثبت نشده است.</span>
                    </div>
                    @endforelse

                </tbody>
            </table>
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
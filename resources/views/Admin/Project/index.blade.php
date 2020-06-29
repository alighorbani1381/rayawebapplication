@extends('Admin.Layout.main')
@section('title', 'لیست پروژه های شما')
@section('header', 'پروژه های شما')
@push('js')
<script src="{{ asset('admin/js/customJS/projects.js') }} "></script>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="header-title m-t-0 m-b-30 inb">
                لیست پروژه ها
            </h4>

            <a href="{{ route('projects.create') }}"
                class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5"> <i class="fa fa-plus-circle"></i>
                <span>افزودن جدید </span> </a>

            @if(hasMember($projects))
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان پروژه</th>
                        <th>کارفرما</th>
                        <th>شناسه پروژه</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">نمایش / فعالسازی</th>
                        <th class="tac">پرداخت</th>
                        <th class="tac">ویرایش</th>
                        <th class="tac">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projects as $row => $project)
                    <tr>
                        <td><?= $row  + 1 ?></td>
                        <td class="projectName">{{ $project->title }}</td>
                        <td>{{ $project->name . " " . $project->lastname }}</td>
                        <td>{{ $project->unique_id }}</td>
                       
                            <td class="tac">
                                @if ($project->status == 'waiting')
                                    <button type="button" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">غیر فعال</button>
                                @endif

                                @if ($project->status == 'ongoing')
                                    <button type="button" class="tac btn btn-warning btn-rounded w-md waves-effect waves-light m-b-5">در حال اجرا</button>
                                @endif

                                @if ($project->status == 'finished')
                                    <button type="button" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">پایان یافته</button>
                                @endif
                            </td>
                            
                      

                        <td class="tac">
                            <a href="{{ route('projects.show', $project->id) }}"class="btn btn-icon waves-effect waves-light btn-success m-b-5"> <i class="fa fa-eye"></i> </a>
                        </td>

                        <td class="tac">
                            <a href="{{ route('earnings.pay', $project->id) }}"class="btn btn-icon waves-effect waves-light btn-primary m-b-5"> <i class="fa fa-money"></i> </a>
                        </td>

                        <td class="tac">
                            <a href="{{ route('projects.edit', $project->id) }}"class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i class="fa fa-pencil"></i> </a>
                        </td>

                        <td class="tac">
                            <form method="post" action="{{ route('projects.destroy', $project->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="delete-project" class="delete-button btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @else
            {!! recordMessage("تا کنون پروژه ای ثبت نشده است") !!}
            @endif
            {{ $projects->links() }}
        </div>
    </div><!-- end col -->
</div>


@if(session()->has('ProjectDelete'))
<script>
    minMbox('پروژه مورد نظر به طور کامل حدف شد.', 350);
</script>
@endif

@if(session()->has('ProjectUpdate'))
<script>
    minMbox("اطلاعات پروژه بروز رسانی شد.", 300);
</script>
@endif


@endsection
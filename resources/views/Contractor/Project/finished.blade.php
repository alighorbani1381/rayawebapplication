@extends('Contractor.Layout.main')
@section('title', 'پروژه های تکمیل شده')
@section('header', 'پروژه های پایان یافته')
@section('content')
<div class="row">    
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            @if(hasMember($projects))
            <h4 class="header-title m-t-0 m-b-30 inb">
                <i class="fa fa-coffee i-fix"></i>
                <span>لیست پروژه های پایان یافته شما</span>
            </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان پروژه</th>
                        <th>توضیحات پروژه (خلاصه)</th>
                        <th class="tac">مشاهده جزئیات</th>
                        <th class="tac">میزان درآمد شما</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projects as $row => $project)
                    <tr>
                        <td><?= $row  + 1 ?></td>
                        <td>{{ $project->title }}</td>
                        <td>{{ mb_substr($project->description,0 , 80) . "..." }}</td>
                        <td class="tac">
                            <a href="{{ route('contractor.projects.show', $project->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                                <i class="fa fa-file-text-o"></i>
                            </a>
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
            {!! recordMessage('تا کنون پروژه ای را به اتمام نرسانده اید.') !!}
            @endif
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
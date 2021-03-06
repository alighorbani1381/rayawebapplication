@extends('Contractor.Layout.main')
@section('title', $project->title)
@section('header', 'لیست درآمد های ' . " « " . $project->title . " » ")
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            @if(hasMember($earnings))
            <h4 class="header-title m-t-0 m-b-30 inb">
                لیست در آمد های شما برای پروژه
                <a href="{{ route('contractor.projects.show', $project->id) }}"
                    style="font-weight: bold; color:rgb(3, 109, 196);">{{ " « ". $project->title  ." » " }}</a>
            </h4>

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="tac">ردیف</th>
                        <th>عنوان درآمد</th>
                        <th class="tac">ثبت کننده این درآمد</th>
                        <th class="tac">تاریخ ثبت درآمد</th>
                        <th class="tac">زمان ثبت درآمد</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">میزان درآمد (تومان)</th>
                        <th class="tac">جزئیات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($earnings as $row => $earning)
                    <tr>
                        <td class="tac"><?= $row  + 1 ?></td>
                        <td>{{ $earning->title }}</td>
                        <td class="tac">{{ $earning->name . " " . $earning->lastname  }}</td>
                        <td class="tac date-show">{{ verta($earning->created_at)->formatJalaliDate() }}</td>
                        <td class="tac date-show">{{ verta($earning->created_at)->format('h:m') }}</td>
                        <td class="tac">
                            @if ($earning->status == 'paid')
                            <button type="button"
                                class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">پرداخت
                                شده</button>
                            @else
                            <button type="button"
                                class="tac btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">بستانکاری</button>
                            @endif
                        </td>

                        <td class="tac">{{ number_format($earning->money_paid) }}</td>
                        <td class="tac">
                            <a href="{{ route('contractor.earning.show', $earning->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-primary m-b-5"> <i
                                    class="fa fa-file-text-o"></i> </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @else
            {!! recordMessage(" تاکنون در آمدی برای پروژه " . $project->title . " ثبت نشده است ") !!}
            @endif

            {{ $earnings->links() }}
        </div>
    </div>
</div>
@endsection
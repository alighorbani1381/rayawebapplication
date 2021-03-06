@extends('Admin.Layout.main')
@section('title', 'لیست در آمد ها')
@section('header', 'لیست درآمد های شما')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="header-title m-t-0 m-b-30 inb">
                <i class="fa fa-money i-fix"></i>
                <span>لیست درآمد های شما</span>
            </h4>

            @can('Create-Earning')
            <a href="{{ route('earnings.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
                <i class="fa fa-plus-circle"></i>
                <span>افزودن جدید </span>
            </a>
            @endcan

            @if(hasMember($earnings))
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان درآمد</th>
                        <th>عنوان پروژه</th>
                        <th>شناسه پروژه</th>
                        <th>میزان درآمد (تومان)</th>
                        <th>قیمت پروژه (تومان)</th>
                        <th class="tac">وضعیت</th>

                        @can('Show-Earning')
                        <th class="tac">جزئیات</th>
                        @endcan

                        @can('Edit-Earning')
                        <th class="tac">ویرایش</th>
                        @endcan

                        @can('Delete-Earning')
                        <th class="tac">حذف</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($earnings as $row => $earning)
                    <tr>
                        <td><?= $row  + 1 ?></td>
                        <td class="earningName">{{ $earning->title }}</td>
                        <td class="projectName">{{ $earning->project_title }}</td>
                        <td>{{ $earning->unique_id }}</td>
                        <td>{{ number_format($earning->received_money) }}</td>
                        <td>{{ number_format($earning->price) }}</td>
                        <td class="tac">
                            @if($earning->status == 'paid')
                            <button type="button"
                                class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">
                                پرداخت شده
                            </button>
                            @else
                            <button type="button"
                                class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">
                                پرداخت نشده
                            </button>
                            @endif
                        </td>

                        @can('Show-Earning')
                        <td class="tac">
                            <a href="{{ route('earnings.show', $earning->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                                <i class="fa fa-file-text-o"></i>
                            </a>
                        </td>
                        @endcan

                        @can('Edit-Earning')
                        <td class="tac">
                            <a href="{{ route('earnings.edit', $earning->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        @endcan

                        @can('Delete-Earning')
                        <td class="tac">
                            <form method="post" action="{{ route('earnings.destroy', $earning->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-earning btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                                        class="fa fa-remove"></i> </button>
                            </form>
                        </td>
                        @endcan
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            {!! recordMessage("شما تا کنون در آمدی ثبت نکرده اید") !!}
            @endif
            {{ $earnings->links() }}
        </div>
    </div>
</div>

@if(session()->has('DeleteEarning'))
<script id="showMessage">
    minMbox('درآمد مورد نظر با موفقیت حذف شد.', 350);
   setTimeout(function(){$("#showMessage").remove();}, 400);
</script>
@endif

@if(session()->has('UpdateEarning'))
<script>
    minMbox('درآمد مورد نظر با موفقیت ویرایش شد.', 350);
</script>
@endif

@endsection

@push('js')
<script src="{{ asset('admin/js/customJS/earnings.js') }} "></script>
@endpush
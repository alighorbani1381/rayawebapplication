@extends('Admin.Layout.main')
@section('title', 'لیست هزینه ها ثابت شما')
@section('header', 'لیست هزینه های ثابت شما')
@push('js')
<script src="{{ asset('admin/js/customJS/costStatic.js') }} "></script>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="header-title m-t-0 m-b-30 inb">
                لیست هزینه های ثابت شما
            </h4>

            <a href="{{ route('static.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
                <i class="fa fa-plus-circle"></i>
                <span>افزودن جدید </span> </a>


            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان هزینه</th>
                        <th>توضیحات (خلاصه)</th>
                        <th>سرگروه</th>
                        <th class="tac">ویرایش</th>
                        <th class="tac">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($staticCosts as $row => $cost)
                    <tr>
                        <td><?= $row  + 1 ?></td>
                        <td class="costStatic">{{ $cost->title }}</td>
                        @if($cost->description == "" || $cost->description == null )
                        <td>-</td>
                        @else
                        <td>{{ $cost->sub_desc }}</td>
                        @endif
                        <td>{{ $cost->main_group }}</td>
                        <td class="tac">
                            <a href="{{ route('static.edit', $cost->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                    class="fa fa-pencil"></i> </a>
                        </td>
                        <td class="tac">
                            <form method="post" action="{{ route('static.destroy', $cost->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-button btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                                        class="fa fa-remove"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $staticCosts->links() }}
        </div>
    </div><!-- end col -->
</div>
@if(session()->has('DeleteCategoryFail'))
<script>
    maxMbox("حذف این مورد با شکست مواجه شد!", "این خدمت دارای زیر گروه است و نمی توان آن را حذف کرد", "error", "آها",350 );
</script>
@endif


@if(session()->has('DeleteCategory'))
<script>
    minMbox('خدمت مورد نظر با موفقیت حذف شد.', 350);
</script>
@endif

@if(session()->has('CategoryUpdate'))
<script>
    minMbox('خدمت مورد نظر با موفقیت ویرایش شد.', 350);
</script>
@endif
@endsection
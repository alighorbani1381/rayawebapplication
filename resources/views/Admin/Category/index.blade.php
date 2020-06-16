@extends('Admin.Layout.main')
@section('title', 'لیست خدمات')
@section('header', 'لیست خدمات شما')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="header-title m-t-0 m-b-30 inb">
                لیست خدمات شما</h4>

            <a href="{{ route('categories.create') }}"
                class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5"> <i class="fa fa-plus-circle"></i>
                <span>افزودن جدید </span> </a>


            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان خدمت</th>
                        <th>توضیحات (خلاصه)</th>
                        <th>سرگروه</th>
                        <th class="tac">ویرایش</th>
                        <th class="tac">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $row => $category)
                    <tr>
                        <td><?= $row  + 1 ?></td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->sub_desc }}</td>
                        <td>{{ $category->main_group }}</td>
                        <td class="tac">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                    class="fa fa-pencil"></i> </a>
                        </td>
                        <td class="tac">
                            <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                                <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                                        class="fa fa-remove"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>
@endsection
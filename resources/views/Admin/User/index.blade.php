@extends('Admin.Layout.main')
@section('title', 'لیست کاربران')
@section('header', 'لیست کاربران')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="header-title m-t-0 m-b-30 inb">لیست کاربران</h4>
            <a href="{{ route('users.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
                 <i class="fa fa-plus-circle"></i> <span>افزودن جدید </span> </a>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>مشخصات کارمند</th>
                        <th>شماره تماس</th>
                        <th>نام کاربری</th>
                        <th>رمزعبور</th>
                        <th class="tac">ویرایش</th>
                        <th class="tac">حذف</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $row => $user)
                    <tr>
                        <td>{{ $row + 1 }}</td>
                        <td>{{ $user->full_name}}</td>
                        <td>{{ $user->phone}}</td>
                        <td>{{ $user->username}}</td>
                        <td>{{ $user->password}}</td>
                        <td class="tac">
                            <a href="" class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                    class="fa fa-pencil"></i> </a>
                        </td>
                        <td class="tac">
                            <form action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i> </button>
                            </form>     
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
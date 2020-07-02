@extends('Admin.Layout.main')
@section('title', 'لیست کاربران')
@section('header', 'لیست کاربران')
@push('js')
<script src="{{ asset('admin/js/customJS/users.js') }} "></script>
@endpush
@section('content')
@if(session()->has('deleteUser'))
<script>
    $(document).ready(function(){showUserDeleteMessage();}); 
</script>
@endif

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
                        <th>مشخصات کاربر</th>
                        <th>نوع کاربر</th>
                        <th class="tac">پروفایل کاربر</th>
                        <th>شماره تماس</th>
                        <th>نام کاربری</th>
                        <th>رمزعبور</th>
                        <th class="tac">جزیات</th>
                        <th class="tac">ویرایش</th>
                        <th class="tac">حذف</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $row => $user)
                    <tr>
                        <td>{{ $row + 1 }}</td>
                        <td class="fullname">{{ $user->full_name}}</td>
                        <td>
                            @if($user->type == "admin")
                            {{ "مدیر" }}
                            @else
                            {{ "کارمند" }}
                            @endif
                        </td>
                        <td class="tac">
                            @if($user->profile != 'default')
                            <img class="tumb-pic-index" src="{{ showPicture('user.profile', $user->profile) }}" alt="{{ $user->full_name}}" title="{{ $user->full_name}}">
                            @else
                            <img class="tumb-pic-index" src="{{ showPicture(null, $user->profile) }}" alt="{{ $user->full_name}}" title="{{ $user->full_name}}">
                            @endif
                        </td>
                        <td>{{ $user->phone}}</td>
                        <td>{{ $user->username}}</td>
                        <td>
                            @if(! Hash::check("raya-px724", $user->password))
                            {{ "Secret" }}
                            <i class="fa fa-lock"></i>
                            @else
                            {{ "raya-px724" }}
                            @endif
                        </td>
                        
                        <td class="tac">
                            <a href="{{ route('users.show', $user->id) }}"class="btn btn-icon waves-effect waves-light btn-success m-b-5"> <i class="fa fa-eye"></i> </a>
                        </td>

                        <td class="tac">
                            <a href="" class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                    class="fa fa-pencil"></i> </a>
                        </td>
                        <td class="tac">
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="delete-user btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                    type="button"> <i class="fa fa-remove"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $users->links() }}

        </div>
    </div>
</div>
@endsection
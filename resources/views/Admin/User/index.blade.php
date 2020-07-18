@extends('Admin.Layout.main')
@section('title', 'لیست کاربران')
@section('header', 'لیست کاربران')
@push('js')
<script src="{{ asset('admin/js/customJS/users.js') }} "></script>
<script src="{{ asset('admin/js/jquery.copy-to-clipboard.js') }} "></script>
@endpush
@section('content')

@if(session()->has('deleteUser'))
<script>
    $(document).ready(function(){showUserDeleteMessage();}); 
</script>
@endif

@if(session()->has('NotDeleteUser'))
<script>
    var title= "حذف این کاربر ممکن نیست!";
    var message = "شما تنها به مجاز به حذف کاربرانی هستید که در سیستم شما تغییراتی ایجاد نکنند";
    var icon = "error";
    var btn = "باشه";
    maxMbox(title, message, icon, btn);
</script>
@endif

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="header-title m-t-0 m-b-30 inb">
                <i class="fa fa-users i-fix"></i>
                <span>لیست کاربران</span>
            </h4>

            @can('Create-User')
            <a href="{{ route('users.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
                <i class="fa fa-plus-circle"></i>
                <span>افزودن جدید </span>
            </a>
            @endcan

            @if(hasMember($users))
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="tac">ردیف</th>
                        <th class="tac">مشخصات کاربر</th>
                        <th class="tac">نوع کاربر</th>
                        <th class="tac">پروفایل کاربر</th>
                        <th class="tac">شماره تماس</th>
                        <th class="tac">نام کاربری</th>
                        <th class="tac">رمزعبور</th>

                        @can('Show-User')
                        <th class="tac">جزئیات</th>
                        @endcan

                        @can('Edit-User')
                        <th class="tac">ویرایش</th>
                        @endcan

                        @can('Delete-User')
                        <th class="tac">حذف</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $row => $user)
                    <tr>
                        <td class="tac">{{ $row + 1 }}</td>
                        <td class="tac fullname">{{ $user->full_name}}</td>
                        <td class="tac">
                            @if($user->type == "admin")
                            {{ "مدیر" }}
                            @else
                            {{ "کارمند" }}
                            @endif
                        </td>
                        <td class="tac">
                            @if($user->profile != 'default' && $user->type == 'contractor')
                            <img class="tumb-pic-index" src="{{ showPicture('user.profile', $user->profile) }}"
                                alt="{{ $user->full_name}}" title="{{ $user->full_name}}">
                            @endif

                            @if($user->profile != 'default' && $user->type == 'admin')
                            <img class="tumb-pic-index" src="{{ showPicture('admin.profile', $user->profile) }}"
                                alt="{{ $user->full_name}}" title="{{ $user->full_name}}">
                            @endif

                            @if($user->profile == 'default')
                            <img class="tumb-pic-index" src="{{ showPicture(null, $user->profile) }}"
                                alt="{{ $user->full_name}}" title="{{ $user->full_name}}">
                            @endif

                        </td>
                        <td class="tac">{{ $user->phone}}</td>
                        <td class="tac user-username">
                            <button type="button" class="btn btn-default" data-container="body" title=""
                                data-toggle="popover" data-placement="top" data-content="کپی شد" data-original-title=""
                                aria-describedby="popover163315">
                                {{ $user->username}}
                            </button>

                        </td>
                        <td class="tac">
                            @if(! Hash::check("raya-px724", $user->password))
                            {{ "Secret" }}
                            <i class="fa fa-lock"></i>
                            @else
                            {{ "raya-px724" }}
                            @endif
                        </td>

                        @can('Show-User')
                        <td class="tac">
                            <a href="{{ route('users.show', $user->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-success m-b-5">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        @endcan

                        @can('Edit-User')
                        <td class="tac">
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        @endcan

                        @can('Delete-User')
                        <td class="tac">
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="delete-user btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                    type="button">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </form>
                        </td>
                        @endcan

                    </tr>
                    @endforeach

                </tbody>
            </table>
            @else
            {!! recordMessage('شما هنوز کاربری ثبت نکرده اید') !!}
            @endif
            {{ $users->links() }}

        </div>
    </div>
</div>

<script>
    $('.user-username').click(function(){
           $(this).CopyToClipboard();
           setTimeout(function() {
               $(".popover").fadeOut('slow');
        }, 1000);
       });
</script>
@endsection
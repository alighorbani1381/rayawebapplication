@extends('Admin.Layout.main')
@section('title', 'تعمیم دادن نقش')
@section('header', 'افزودن نقش برای کاربر')
@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30"></h4>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form class="form-horizontal" role="form" action="{{ route('roles.user.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">

                            @if($user->profile != 'default')
                            <img style="width: 8%;display: inline-block;"
                                src="{{ showPicture('admin.profile', $user->profile) }}" alt="{{ $user->fullName }}"
                                title="{{ $user->fullName }}" class="img-circle img-thumbnail img-responsive">
                            @else
                            <img style="width: 8%;display: inline-block;" src="/admin/images/users/default.png"
                                alt="{{ $user->fullName }}" title="{{ $user->fullName }}"
                                class="img-circle img-thumbnail img-responsive">
                            @endif

                            <h3 style="display: inline-block;">{{ $user->full_name }}</h3>
                        </div>

                        <!-- roles Box !-->
                        <div class="form-group">
                            <label style="height: 100%;">
                                نقش های این کاربر
                            </label>

                            <select multiple class="form-control" name="role_id[]" required>
                                @foreach($roles as $key => $role)
                                    @foreach ($userRoles as $userRole)
                                        <option @if($userRole->id == $role->id){{"selected"}}@endif value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>


                        <!-- Submit Button !-->
                        <div class="form-group">
                            @if(hasMember($userRoles))
                            <button type="submit" class="btn btn-primary waves-effect waves-light submit-button">
                                ویرایش نقش های این کاربر
                            </button>
                            @else
                            <button type="submit" class="btn btn-success waves-effect waves-light submit-button">
                                افزودن نقش های این کاربر
                            </button>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
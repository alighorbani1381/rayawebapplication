@extends('Admin.Layout.main')
@section('title', 'تعمیم دادن نقش')
@section('header', 'افزودن نقش برای کاربر')
@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30"></h4>
            <div class="row">
                <div class="col-lg-11">
                    <form class="form-horizontal" role="form" action="{{ route('roles.user.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <h3>{{ $user->full_name }}</h3>
                        </div>

                        <!-- roles Box !-->
                        <div class="form-group">
                            <label style="height: 100%; margin-right:4%;">
                                نقش های این کاربر
                            </label>

                            <div class="role-list">
                                @foreach($roles as $key => $role)
                                <div class="pretty p-icon p-round p-pulse" style="margin: 8px;">
                                    <input type="checkbox" name="role_id[]" value="{{$role->id}}">
                                    <div class="state p-success">
                                        <label>{{ $role->title}}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="icon mdi mdi-check"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>


                        <!-- Submit Button !-->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success waves-effect waves-light submit-button">
                                افزودن کاربر
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
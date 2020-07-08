@extends('Admin.Layout.main')
@section('title', 'افزودن خدمات جدید')
@section('header', 'افزودن خدمات جدید')
@section('content')
<div class="row">
   <div class="col-sm-8 col-sm-offset-2">
      <div class="card-box">
         <h4 class="header-title m-t-0 m-b-30">افزودن نقش جدید</h4>
         <div class="row">
            <div class="col-lg-11">
               <form class="form-horizontal" role="form" action="{{ route('roles.update', $role->id) }}" method="post">
                  @csrf
                  @method('PATCH')
                  <!-- Alert Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">نکته بسیار مهم</label>
                     <div class="col-md-10">
                        <div class="alert alert-warning">
                           <i class="fa fa-warning"></i>
                           <span>
                             در صورت تغییر سطح دسترسی این نقش برای کاربرانی که این نقش را دارند نیز اعمال می شود.
                           </span>
                        </div>
                     </div>
                  </div>

                  <!-- Permission Title Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">عنوان نقش (فارسی)</label>
                     <div class="col-md-10">
                        <input type="text" name="title" required class="form-control" value="{{ $role->title }}"
                           placeholder="عنوان نقش را وارد کنید ...">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>

                  <!-- Permission Name Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">نام نقش (انگلیسی)</label>
                     <div class="col-md-10">
                        <input type="name" name="name" required class="form-control" value="{{ $role->name }}"
                           placeholder="نام نقش را وارد کنید ...">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>

                  <!-- Permissions Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">
                        سطوح دسترسی
                     </label>

                     <div class="col-md-10">
                        <table id="datatable" class="table table-striped table-bordered">
                           @foreach($permissions as $key => $permission)
                           @if($key % 2 == 0)
                           <tr>
                              @endif


                              @php
                              $hasRole = "";
                              foreach($rolePermissions as $rolePermission)
                              if($rolePermission->id == $permission->id)
                              $hasRole = "checked";
                              @endphp

                              <td class="acl-item">
                                 <div class="acl-param pretty p-icon p-round p-pulse" style="margin: 8px;">
                                    <input type="checkbox" name="permission_id[]" {{ $hasRole }}
                                       value="{{$permission->id}}">
                                    <div class="state p-success">
                                       <label>{{ $permission->title}}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <i class="icon mdi mdi-check"></i>
                                    </div>
                                 </div>
                              </td>

                              @if($key+1 % 4 == 0)
                           </tr>
                           @endif
                           @endforeach
                        </table>
                     </div>
                  </div>


                  <!-- Submit Button !-->
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary waves-effect waves-light submit-button">
                        ویرایش نقش
                     </button>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
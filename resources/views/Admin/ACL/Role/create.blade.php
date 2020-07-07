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
               <form class="form-horizontal" role="form" action="{{ route('roles.store') }}" method="post">
                  @csrf

                  <!-- Permission Title Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">عنوان نقش (فارسی)</label>
                     <div class="col-md-10">
                        <input type="text" name="title" required class="form-control" value="{{ old('title') }}"
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
                        <input type="name" name="name" required class="form-control" value="{{ old('title') }}"
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

                              <td class="acl-item">
                                 <div class="acl-param pretty p-icon p-round p-pulse" style="margin: 8px;">
                                    <input type="checkbox" name="permission_id[]" value="{{$permission->id}}">
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
                     <button type="submit" class="btn btn-success waves-effect waves-light submit-button">
                        افزودن نقش
                     </button>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
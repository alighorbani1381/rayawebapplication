@extends('Admin.Layout.main')
@section('title', 'افزودن خدمات جدید')
@section('header', 'افزودن خدمات جدید')
@section('content')
<div class="row">
   <div class="col-sm-8 col-lg-offset-2">
      <div class="card-box">
         <h4 class="header-title m-t-0 m-b-30">افزودن سطح دسترسی جدید</h4>
         <div class="row">
            <div class="col-lg-11">
               <form class="form-horizontal" role="form" action="{{ route('per.store') }}" method="post">
                  @csrf

                  <!-- Permission Title Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">عنوان سطح دسترسی (فارسی)</label>
                     <div class="col-md-10">
                        <input type="text" name="title" required class="form-control" value="{{ old('title') }}"
                           placeholder="عنوان سطح دسترسی را وارد کنید ...">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>

                  <!-- Permission Name Box !-->
                  <div class="form-group">
                     <label class="col-md-2 control-label">نام سطح دسترسی (انگلیسی)</label>
                     <div class="col-md-10">
                        <input type="name" name="name" required class="form-control" value="{{ old('title') }}"
                           placeholder="متن سطح دسترسی را وارد کنید ...">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>

            
                  <!-- Submit Button !-->
                  <div class="form-group">
                     <button type="submit" class="btn btn-success waves-effect waves-light submit-button">
                        افزودن سطح دسترسی
                    </button>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
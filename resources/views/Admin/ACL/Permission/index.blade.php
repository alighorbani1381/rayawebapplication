@extends('Admin.Layout.main')
@section('title', 'لیست سطح دسترسی')
@section('header', 'لیست سطح دسترسی شما')
@section('content')
<div class="row">
   <div class="col-sm-12">
      <div class="card-box table-responsive">


         <h4 class="header-title m-t-0 m-b-30 inb">
            @if(hasMember($permissions))
            لیست سطح دسترسی های شما
            @else
            افزودن سطح دسترسی
            @endif
         </h4>
         <a href="{{ route('per.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
            <i class="fa fa-plus-circle"></i>
            <span>افزودن جدید </span>
         </a>

         @if(hasMember($permissions))
         <!-- Table Start !-->
         <table id="datatable" class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th class="tac">ردیف</th>
                  <th class="tac">عنوان سطح دسترسی (فارسی)</th>
                  <th class="tac">نام سطح دسترسی (انگلیسی)</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($permissions as $row => $permission)
               <tr>
                  <td class="tac"><?= $row  + 1 ?></td>
                  <td class="tac permissionName">{{ $permission->title }}</td>
                  <td class="tac permissionName">{{ $permission->name }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <!-- Table End !-->

         @else
         {!! recordMessage('هیچ سطح دسترسی در سیستم ثبت نشده است') !!}
         @endif
      </div>
   </div>
</div>
@endsection
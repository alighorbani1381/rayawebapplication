@extends('Admin.Layout.main')
@section('title', 'لیست نقش')
@section('header', 'لیست نقش شما')
@section('content')
<div class="row">
   <div class="col-sm-12">
      <div class="card-box table-responsive">


         <h4 class="header-title m-t-0 m-b-30 inb">
            @if(hasMember($roles))
            لیست نقش های شما
            @else
            افزودن نقش
            @endif
         </h4>
         <a href="{{ route('roles.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
            <i class="fa fa-plus-circle"></i>
            <span>افزودن جدید </span>
         </a>

         @if(hasMember($roles))
         <!-- Table Start !-->
         <table id="datatable" class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th class="tac">ردیف</th>
                  <th class="tac">عنوان نقش (فارسی)</th>
                  <th class="tac">نام نقش (انگلیسی)</th>
                  <th class="tac">ویرایش</th>
                  <th class="tac">حذف</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($roles as $row => $role)
               <tr>
                  <td class="tac"><?= $row  + 1 ?></td>
                  <td class="tac roleName">{{ $role->title }}</td>
                  <td class="tac roleName">{{ $role->name }}</td>
                  <td class="tac">
                     <a href="{{ route('roles.edit', $role->id) }}"
                        class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i class="fa fa-pencil"></i> </a>
                  </td>
                  <td class="tac">
                     <form method="post" action="{{ route('roles.destroy', $role->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                           class="delete-button btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                              class="fa fa-remove"></i> </button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <!-- Table End !-->

         @else
         {!! recordMessage('هیچ نقشی در سیستم ثبت نشده است') !!}
         @endif
      </div>
   </div>
</div>

@if(session()->has('Error-Sub'))
<script>
   var title ="حذف این مورد با شکست مواجه شد!";
   var part1 = "این نقش دارای" + " {{Session::get('Error-Sub')}} " + "زیر";
   var part2 ="گروه است و نمی توان آن را حذف کرد";
   var message = part1 + part2;
   var btn = "آها";
   maxMbox(title, message, "error", btn, 350 );
</script>
@endif

@if(session()->has('Deleterole'))
<script>
   minMbox('نقش مورد نظر با موفقیت حذف شد.', 350);
</script>
@endif

@if(session()->has('roleUpdate'))
<script>
   minMbox('نقش مورد نظر با موفقیت ویرایش شد.', 350);
</script>
@endif

@endsection
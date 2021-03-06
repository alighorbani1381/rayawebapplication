@extends('Admin.Layout.main')
@section('title', 'لیست خدمات')
@section('header', 'لیست خدمات شما')
@push('js')
<script src="{{ asset('admin/js/customJS/categories.js') }} "></script>
@endpush
@section('content')
<div class="row">
   <div class="col-sm-12">
      <div class="card-box table-responsive">


         <h4 class="header-title m-t-0 m-b-30 inb">
            @if(hasMember($categories))
            <i class="fa fa-shopping-bag i-fix"></i>
            لیست خدمات شما
            @else
            افزودن خدمات
            @endif
         </h4>

         @can('Create-Category')
         <a href="{{ route('categories.create') }}" class="cbfl btn btn-info btn-bordred waves-effect waves-dark m-b-5">
            <i class="fa fa-plus-circle"></i>
            <span>افزودن جدید </span>
         </a>
         @endcan

         @if(hasMember($categories))
         <!-- Table Start !-->
         <table id="datatable" class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th>ردیف</th>
                  <th>عنوان خدمت</th>
                  <th>توضیحات (خلاصه)</th>
                  <th>سرگروه</th>

                  @can('Edit-Category')
                  <th class="tac">ویرایش</th>
                  @endcan

                  @can('Delete-Category')
                  <th class="tac">حذف</th>
                  @endcan
               </tr>
            </thead>
            <tbody>
               @foreach ($categories as $row => $category)
               <tr>
                  <td><?= $row  + 1 ?></td>
                  <td class="categoryName">{{ $category->title }}</td>
                  <td>{{ $category->sub_desc }}</td>
                  <td>{{ $category->main_group }}</td>

                  @can('Edit-Category')
                  <td class="tac">
                     <a href="{{ route('categories.edit', $category->id) }}"
                        class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i class="fa fa-pencil"></i> </a>
                  </td>
                  @endcan

                  @can('Delete-Category')
                  <td class="tac">
                     <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                           class="delete-button btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                              class="fa fa-remove"></i> </button>
                     </form>
                  </td>
                  @endcan

               </tr>
               @endforeach
            </tbody>
         </table>
         <!-- Table End !-->

         @else
         {!! recordMessage('هیچ خدماتی توی سیستم ثبت نشده') !!}
         @endif
      </div>
   </div>
</div>

@if(session()->has('Error-Sub'))
<script>
   var title ="حذف این مورد با شکست مواجه شد!";
   var part1 = "این خدمت دارای" + " {{Session::get('Error-Sub')}} " + "زیر";
   var part2 ="گروه است و نمی توان آن را حذف کرد";
   var message = part1 + part2;
   var btn = "آها";
   maxMbox(title, message, "error", btn, 350 );
</script>
@endif

@if(session()->has('DeleteCategory'))
<script>
   minMbox('خدمت مورد نظر با موفقیت حذف شد.', 350);
</script>
@endif

@if(session()->has('CategoryUpdate'))
<script>
   minMbox('خدمت مورد نظر با موفقیت ویرایش شد.', 350);
</script>
@endif

@endsection
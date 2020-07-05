@extends('Contractor.Layout.main')
@section('title', 'لیست بستانکاری ها')
@section('header', 'لیست بستانکاری های شما')
@section('content')
<div class="row">
   <div class="col-sm-12">
      <div class="card-box table-responsive">
         @if(hasMember($credits))
         <h4 class="header-title m-t-0 m-b-30 inb">
            لیست بستانکاری های شما
         </h4>

         <!-- Table Start !-->
         <table id="datatable" class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th>ردیف</th>
                  <th>عنوان بستانکاری</th>
                  <th>ثبت کننده</th>
                  <th class="tac">تاریخ ثبت</th>
                  <th class="tac">زمان ثبت</th>
                  <th>عنوان پروژه</th>
                  <th>شناسه پروژه</th>
                  <th>میزان درآمد (تومان)</th>
                  <th class="tac">جزئیات</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($credits as $row => $earning)
               <tr>
                  <td><?= $row  + 1 ?></td>
                  <td>{{ $earning->title }}</td>
                  <td>{{ $earning->name . " " . $earning->lastname  }}</td>
                  <td class="tac date-show">{{ verta($earning->created_at)->formatJalaliDate() }}</td>
                  <td class="tac date-show">{{ verta($earning->created_at)->format('h:m') }}</td>
                  <td>{{ $earning->project_title }}</td>
                  <td>{{ $earning->unique_id }}</td>
                  <td>{{ number_format($earning->money_paid) }}</td>
                  <td class="tac">
                     <a href="{{ route('contractor.earning.show', $earning->id) }}"
                        class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
                         <i class="fa fa-file-text-o"></i> 
                    </a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <!-- Table End !-->

         @else
         {!! recordMessage("بستانکاری برای شما ثبت نشده است.") !!}
         @endif
         {{ $credits->links() }}
      </div>
   </div>
</div>
@endsection
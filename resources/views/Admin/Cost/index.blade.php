@extends('Admin.Layout.main')
@section('title', 'لیست هزینه')
@section('header', 'لیست هزینه')
@push('js')
<script src="{{ asset('admin/js/customJS/costs.js') }} "></script>
@endpush
@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card-box">
         <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active">
               <a href="#extra" id="extra-costs" role="tab" data-toggle="tab" aria-controls="extra"
                  aria-expanded="true">
                  <i class="fa fa-credit-card i-fix"></i>
                  <span>هزینه های جانبی</span>
               </a>
            </li>
            <li role="presentation" class="dropdown">
               <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"
                  aria-controls="myTabDrop1-contents">
                  <i class="fa fa-book i-fix"></i>
                  <span>هزینه های مربوط به پروژه</span>
                  <span class="caret"></span>
               </a>
               <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                  <li>
                     <a href="#dropdown1" role="tab" id="dropdown1-tab" data-toggle="tab"
                        aria-controls="dropdown1">هزینه های پایه پروژه</a>
                  </li>
                  <li>
                     <a href="#dropdown2" role="tab" id="dropdown2-tab" data-toggle="tab"
                        aria-controls="dropdown2">پرداختی به پیمانکاران</a>
                  </li>
               </ul>
            </li>
         </ul>


         <div class="tab-content">

            {{--  Extra Costs Start --}}
            <div role="tabpanel" class="tab-pane fade in active" id="extra" aria-labelledby="extra-costs">

               @if($costs['extra']->count() != 0)
               <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th class="tac">ردیف</th>
                        <th class="tac">نوع هزینه</th>
                        <th>عنوان هزینه</th>
                        <th>توضیحات (خلاصه)</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">زمان ثبت</th>

                        @can('Show-Cost')
                        <th class="tac">جزئیات</th>
                        @endcan

                        @can('Edit-Cost')
                        <th class="tac">ویرایش</th>
                        @endcan

                        @can('Delete-Cost')
                        <th class="tac">حذف</th>
                        @endcan
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($costs['extra'] as $row => $cost)
                     <tr>
                        <td class="tac"><?= $row  + 1 ?></td>
                        <td class="tac">{{ $cost->type_title }}</td>
                        <td class="costTitle" type="extra">{{ $cost->title }}</td>
                        <td>{{ $cost->sub_desc }}</td>
                        <td class="tac">
                           @if ($cost->status == 'paid')
                           <button type="button"
                              class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">
                              پرداخت شده
                           </button>
                           @else
                           <button type="button"
                              class="tac btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">در
                              پرداخت نشده
                           </button>
                           @endif
                        </td>
                        @php $time = verta($cost->created_at); @endphp
                        <td class="tac date-show">{{ $time->format('Y/n/j H:i') }}</td>
                        

                        @can('Show-Cost')
                        <td class="tac">
                           <a href="{{ route('costs.show', $cost->id) }}"
                              class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                              <i class="fa fa-file-text-o"></i>
                           </a>
                        </td>
                        @endcan

                        @can('Edit-Cost')
                        <td class="tac">
                           <a href="{{ route('costs.edit', $cost->id) }}"
                              class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i class="fa fa-pencil"></i>
                           </a>
                        </td>
                        @endcan


                        @can('Delete-Cost')
                        <td class="tac">
                           <form method="post" action="{{ route('costs.destroy', $cost->id) }}">
                              @csrf
                              @method('DELETE')
                              <button type="button"
                                 class="delete-cost btn btn-icon waves-effect waves-light btn-danger m-b-5">
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
               {!! recordMessage('تا کنون هزینه جانبی به ثبت نرسیده') !!}
               @endif

            </div>
            {{--  Extra Costs End --}}

            {{--  Static Project Costs Start --}}
            <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
               @if($costs['project_base']->count() != 0)
               <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th class="tac">ردیف</th>
                        <th class="tac">نوع هزینه</th>
                        <th>عنوان هزینه</th>
                        <th>توضیحات (خلاصه)</th>
                        <th class="tac">عنوان پروژه</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">زمان ثبت</th>

                        @can('Show-Cost')
                        <th class="tac">جزئیات</th>
                        @endcan

                        @can('Edit-Cost')
                        <th class="tac">ویرایش</th>
                        @endcan

                        @can('Delete-Cost')
                        <th class="tac">حذف</th>
                        @endcan

                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($costs['project_base'] as $row => $cost)
                     <tr>
                        <td class="tac"><?= $row  + 1 ?></td>
                        <td class="tac">{{ $cost->type_title }}</td>
                        <td class="costTitle" type="project_base">{{ $cost->title }}</td>
                        <td>{{ $cost->sub_desc }}</td>
                        <td class="tac projectName">{{ $cost->project_title }}</td>
                        <td class="tac">
                           @if ($cost->status == 'paid')
                           <button type="button"
                              class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">
                              پرداخت شده
                           </button>
                           @else
                           <button type="button"
                              class="tac btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">
                              پرداخت نشده
                           </button>
                           @endif
                        </td>
                        @php $time = verta($cost->created_at); @endphp
                        <td class="tac date-show">{{ $time->format('Y/n/j H:i') }}</td>
                        
                        
                        @can('Show-Cost')
                        <td class="tac">
                           <a href="{{ route('costs.show', $cost->id) }}"
                              class="btn btn-icon waves-effect waves-light btn-primary m-b-5">
                              <i class="fa fa-file-text-o"></i>
                           </a>
                        </td>
                        @endcan

                        @can('Edit-Cost')
                        <td class="tac">
                           <a href="{{ route('costs.edit', $cost->id) }}"
                              class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                              <i class="fa fa-pencil"></i>
                           </a>
                        </td>
                        @endcan

                        @can('Delete-Cost')
                        <td class="tac">
                           <form method="post" action="{{ route('costs.destroy', $cost->id) }}">
                              @csrf
                              @method('DELETE')
                              <button type="button"
                                 class="delete-cost btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                 <i class="fa fa-remove"></i> </button>
                           </form>
                        </td>
                        @endcan

                     </tr>
                     @endforeach
                  </tbody>
               </table>
               @else
               {!! recordMessage('تا کنون هزینه ثابت برای پروژه ای ثبت نشده') !!}
               @endif

            </div>
            {{--  Static Project Costs End --}}

            {{--  Project Costs Start --}}
            <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
               @if($costs['contractor']->count() != 0)
               <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th class="tac">ردیف</th>
                        <th>عنوان هزینه</th>
                        <th>پرداخت شده به</th>
                        <th>توضیحات (خلاصه)</th>
                        <th>عنوان پروژه</th>
                        <th class="tac">وضعیت</th>
                        <th class="tac">زمان ثبت</th>
                        <th class="tac">نوع هزینه</th>

                        @can('Show-Cost')
                        <th class="tac">جزئیات</th>
                        @endcan

                        @can('Edit-Cost')
                        <th class="tac">ویرایش</th>
                        @endcan

                        @can('Delete-Cost')
                        <th class="tac">حذف</th>
                        @endcan

                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($costs['contractor'] as $row => $cost)
                     <tr>
                        <td class="tac"><?= $row  + 1 ?></td>
                        <td class="costTitle" type="contractor">{{ $cost->title }}</td>
                        <td class="userName">{{ $cost->user_name . " " . $cost->user_lastname  }}</td>
                        <td>{{ $cost->sub_desc }}</td>
                        <td class="projectName">{{ $cost->project_title  }}</td>
                        <td class="tac">
                           @if ($cost->status == 'paid')
                           <button type="button"
                              class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">
                              پرداخت شده
                           </button>
                           @else
                           <button type="button"
                              class="tac btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">
                              پرداخت نشده
                           </button>
                           @endif
                        </td>
                        @php $time = verta($cost->created_at); @endphp
                        <td class="tac date-show">{{ $time->format('Y/n/j H:i') }}</td>
                        <td class="tac">{{ $cost->type_title }}</td>

                        @can('Show-Cost')
                        <td class="tac">
                           <a href="{{ route('costs.show', $cost->id) }}"
                              class="btn btn-icon waves-effect waves-light btn-primary m-b-5"> <i
                                 class="fa fa-file-text-o"></i> </a>
                        </td>
                        @endcan

                        @can('Edit-Cost')
                        <td class="tac">
                           <a href="{{ route('costs.edit', $cost->id) }}"
                              class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i class="fa fa-pencil"></i>
                           </a>
                        </td>
                        @endcan

                        @can('Delete-Cost')
                        <td class="tac">
                           <form method="post" action="{{ route('costs.destroy', $cost->id) }}">
                              @csrf
                              @method('DELETE')
                              <button type="button"
                                 class="delete-cost btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                 <i class="fa fa-remove"></i> </button>
                           </form>
                        </td>
                        @endcan

                     </tr>
                     @endforeach
                  </tbody>
               </table>
               @else
               {!! recordMessage('تا کنون دست مزدی برای کارمندان خود ثبت نکرده اید') !!}
               @endif
            </div>
            {{--  Project Costs Start --}}
         </div>
      </div>
   </div>
</div>

@if(session()->has('DeleteCost'))
<script>
   var message = "هزینه مورد نظر با موفقیت حذف شد.";
   minMbox(message, 250);
</script>
@endif

@if(session()->has('UpdateCost'))
<script>
   var message = "هزینه مورد نظر با موفقیت بروزرسانی شد.";
   minMbox(message, 250);
</script>
@endif

@if(session()->has('ProjectStore'))
<script>
   var message = "هزینه با موفقیت ثبت شد .";
   minMbox(message, 250);
</script>
@endif


@endsection
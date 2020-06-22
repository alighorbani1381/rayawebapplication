@extends('Admin.Layout.main')
@section('title', 'لیست هزینه')
@section('header', 'لیست هزینه')
{{-- @push('js')

@endpush --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box">

            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#extra" id="extra-costs" role="tab" data-toggle="tab" aria-controls="extra"
                        aria-expanded="true">
                        هزینه های جانبی
                    </a>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"
                        aria-controls="myTabDrop1-contents">
                        هزینه های مربوط به پروژه
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
                <div role="tabpanel" class="tab-pane fade in active" id="extra" aria-labelledby="extra-costs">
                  
                 
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان هزینه</th>
                                <th>توضیحات (خلاصه)</th>
                                <th>نوع هزینه</th>
                                <th class="tac">ویرایش</th>
                                <th class="tac">حذف</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach ($costs['extra'] as $row => $cost)
                            <tr>
                                <td><?= $row  + 1 ?></td>
                                <td class="categoryName">{{ $cost->title }}</td>
                                <td>{{ $cost->sub_desc }}</td>
                                <td>
                                    @if($cost->type != null)
                                        {{ $cost->type }}
                                    @else
                                        {{ "ندارد" }}
                                    @endif
                                </td>
                                <td class="tac">
                                    <a href="{{ route('costs.edit', $cost->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                            class="fa fa-pencil"></i> </a>
                                </td>
                                <td class="tac">
                                    <form method="post" action="{{ route('costs.destroy', $cost->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-button btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                                                class="fa fa-remove"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
        
                        </tbody>
                    </table>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
                    <p>هزینه های پایه ای پروژه</p>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
                    <p> پرداختی به پیمانکاران </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
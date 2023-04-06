@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('StudentsTranslation.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('StudentsTranslation.list_students') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{ route('Students.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('StudentsTranslation.addstydant') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('StudentsTranslation.name') }}</th>
                                            <th>{{ trans('StudentsTranslation.email') }}</th>
                                            <th>{{ trans('StudentsTranslation.gender') }}</th>
                                            <th>{{ trans('StudentsTranslation.Grade') }}</th>
                                            <th>{{ trans('StudentsTranslation.classrooms') }}</th>
                                            <th>{{ trans('StudentsTranslation.section') }}</th>
                                            <th>{{ trans('StudentsTranslation.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->genders->name }}</td>
                                                <td>{{ $student->gardes->name }}</td>
                                                <td>{{ $student->classrooms->name }}</td>
                                                <td>{{ $student->sections->name }}</td>

                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                                href="{{ route('Students.show', $student->id) }}"><i
                                                                    style="color: #ffc107"
                                                                    class="far fa-eye "></i>&nbsp; عرض بيانات الطالب</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('Students.edit', $student->id) }}"><i
                                                                    style="color:green" class="fa fa-edit"></i>&nbsp;
                                                                تعديل بيانات الطالب</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('receipt.show', $student->id) }}"><i
                                                                    style="color: #21292e"
                                                                    class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;سند
                                                                قبض</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('feesinvoices.show', $student->id) }}"><i
                                                                    style="color: #0000cc"
                                                                    class="fa fa-edit"></i>&nbsp;اضافة فاتورة
                                                                رسوم&nbsp;</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('paymentStudent.show', $student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;
                                                                استبعاد رسوم</a>
                                                            <a class="dropdown-item"
                                                                href="{{route('StudentPremium.show',$student->id)}}"><i
                                                                    style="color:goldenrod"
                                                                    class="fas fa-donate"></i>&nbsp; &nbsp;سند صرف</a>
                                                            <a class="dropdown-item"
                                                                data-target="#Delete_Student{{ $student->id }}"
                                                                data-toggle="modal"
                                                                href="##Delete_Student{{ $student->id }}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                حذف بيانات الطالب</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            @include('pages.Students.Delete')
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection

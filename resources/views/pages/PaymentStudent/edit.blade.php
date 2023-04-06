@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل معالجة رسوم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')

    تعديل معالجة رسوم : <label style="color: red">{{ $Payment_student->student->name}}</label>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('paymentStudent.update', $Payment_student->id) }}" method="post" autocomplete="off">
                    @method('PUT')
                
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>المبلغ : <span class="text-danger">*</span></label>
                                <input class="form-control" name="Debit" value="{{$Payment_student->amount }}"
                                    type="number">
                                    
                                <input type="hidden" name="student_id" value="{{ $Payment_student->student->id}}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>البيان : <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $Payment_student->description}}</textarea>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

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

@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('StudentsTranslation.Student_Edit') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('StudentsTranslation.Student_Edit') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <form action="{{ route('Students.update', $Students->id) }}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('StudentsTranslation.personal_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('StudentsTranslation.name_ar') }} : <span
                                        class="text-danger">*</span></label>
                                <input value="{{ $Students->getTranslation('name', 'ar') }}" type="text"
                                    name="name_ar" class="form-control">
                                <input type="hidden" name="id" value="{{ $Students->id }}">
                                @error('name_ar')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('StudentsTranslation.name_en') }} : <span
                                        class="text-danger">*</span></label>
                                <input value="{{ $Students->getTranslation('name', 'en') }}" class="form-control"
                                    name="name_en" type="text">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('StudentsTranslation.email') }} : </label>
                                <input type="email" value="{{ $Students->email }}" name="email"
                                    class="form-control">

                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('StudentsTranslation.password') }} :</label>
                                <input value="{{ $Students->password }}" type="password" name="password"
                                    class="form-control">

                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{ trans('StudentsTranslation.gender') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="gender_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Genders as $Gender)
                                        <option value="{{ $Gender->id }}"
                                            {{ $Gender->id == $Students->gender_id ? 'selected' : '' }}>
                                            {{ $Gender->name }}</option>
                                    @endforeach
                                </select>

                                @error('gender_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{ trans('StudentsTranslation.Nationality') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="nationalitie_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($nationals as $nal)
                                        <option value="{{ $nal->id }}"
                                            {{ $nal->id == $Students->notionalitio_id ? 'selected' : '' }}>
                                            {{ $nal->name }}</option>
                                    @endforeach
                                </select>

                                @error('nationalitie_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bg_id">{{ trans('StudentsTranslation.blood_type') }} : </label>
                                <select class="custom-select mr-sm-2" name="blood_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($bloods as $bg)
                                        <option value="{{ $bg->id }}"
                                            {{ $bg->id == $Students->type_blood_id ? 'selected' : '' }}>
                                            {{ $bg->name }}</option>
                                    @endforeach
                                </select>
                                @error('blood_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('StudentsTranslation.Date_of_Birth') }} :</label>
                                <input class="form-control" type="text" value="{{ $Students->barth_day }}"
                                    id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd">
                                    @error('Date_Birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                    </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('StudentsTranslation.Student_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('StudentsTranslation.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Grades as $Grade)
                                        <option value="{{ $Grade->id }}"
                                            {{ $Grade->id == $Students->grade_id ? 'selected' : '' }}>
                                            {{ $Grade->name }}</option>
                                    @endforeach
                                </select>

                                @error('Grade_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Classroom_id">{{ trans('StudentsTranslation.classrooms') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{ $Students->classroom_id }}">{{ $Students->classrooms->name }}
                                    </option>
                                </select>

                                @error('Classroom_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="section_id">{{ trans('StudentsTranslation.section') }} : </label>
                                <select class="custom-select mr-sm-2" name="section_id">
                                    <option value="{{ $Students->section_id }}"> {{ $Students->sections->name }}
                                    </option>
                                </select>

                                @error('section_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parent_id">{{ trans('StudentsTranslation.parent') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="parent_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}"
                                            {{ $parent->id == $Students->father_id ? 'selected' : '' }}>
                                            {{ $parent->name }}</option>
                                    @endforeach
                                </select>

                                @error('parent_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('StudentsTranslation.academic_year') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}"
                                            {{ $year == $Students->academic_year ? 'selected' : ' ' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>

                                @error('academic_year')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('GradesTranslation.Save') }}</button>
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
<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "/getclasses/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Classroom_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id"]').append(
                                '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                                );
                            $('select[name="Classroom_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "/getsections/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection

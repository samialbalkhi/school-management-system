@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('StudentsTranslation.Student_details') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('StudentsTranslation.Student_details') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{ trans('StudentsTranslation.Student_details') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02"
                                    aria-selected="false">{{ trans('StudentsTranslation.Attachments') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ trans('StudentsTranslation.name') }}</th>
                                            <td>{{ $Student->name }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.email') }}</th>
                                            <td>{{ $Student->email }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.gender') }}</th>
                                            <td>{{ $Student->genders->name }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.nationalitie_id') }}</th>
                                            <td>{{ $Student->notionalitios->name }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ trans('StudentsTranslation.Grade') }}</th>
                                            <td>{{ $Student->gardes->name }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.classrooms') }}</th>
                                            <td>{{ $Student->classrooms->name }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.section') }}</th>
                                            <td>{{ $Student->sections->name }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.Date_of_Birth') }}</th>
                                            <td>{{ $Student->barth_day }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ trans('StudentsTranslation.parent') }}</th>
                                            <td>{{ $Student->fathers->name }}</td>
                                            <th scope="row">{{ trans('StudentsTranslation.academic_year') }}</th>
                                            <td>{{ $Student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{route('attachments_route') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        for="academic_year">{{ trans('StudentsTranslation.Attachments') }}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple
                                                        required>
                                                    <input type="hidden" name="student_name"
                                                        value="{{ $Student->name }}">
                                                    <input type="hidden" name="student_id"
                                                        value="{{ $Student->id }}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{ trans('StudentsTranslation.submit') }}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{ trans('StudentsTranslation.filename') }}</th>
                                                <th scope="col">{{ trans('StudentsTranslation.created_at') }}</th>
                                                <th scope="col">{{ trans('StudentsTranslation.Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{ $attachment->id }}</td>
                                                    <td>{{ $attachment->name }}</td>
                                                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{url('Download_attachment')}}/{{$Student->name}}/{{ $attachment->name }}"role="button"><i class="fas fa-download"></i>&nbsp;
                                                            {{ trans('StudentsTranslation.Download') }}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_img{{ $attachment->id }}"
                                                            title="{{ trans('Grades_trans.Delete') }}">{{ trans('StudentsTranslation.delete') }}
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('pages.Students.Delete_img')
                                            @endforeach
                                        </tbody>
                                    </table>
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

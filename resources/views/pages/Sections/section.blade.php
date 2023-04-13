@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('SectionTranslation.add_section') }}</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($list_grades as $Grade)
                            <div class="acd-group">
                                <a href="#" class="acd-heading">{{ $Grade->name }}</a>
                                <div class="acd-des">

                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('SectionTranslation.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('SectionTranslation.Name_Class') }}
                                                                    </th>
                                                                    <th>{{ trans('SectionTranslation.Status') }}</th>
                                                                    <th>{{ trans('SectionTranslation.Processes') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($Grade->sections as $list)
                                                                    <tr>

                                                                        <td>{{ $list->id }}</td>
                                                                        <td>{{ $list->name }}</td>
                                                                        <td>{{ $list->classrooms->name }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($list->status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('SectionTranslation.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('SectionTranslation.Status_Section_No') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>

                                                                            <a href="#"
                                                                                class="btn btn-outline-info btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#edit{{ $list->id }}">{{ trans('GradesTranslation.Update') }}</a>
                                                                            <a href="#"
                                                                                class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#delete{{ $list->id }}">{{ trans('GradesTranslation.delete') }}</a>
                                                                        </td>

                                                                    </tr>


                                                                    <!--update section  -->
                                                                    <div class="modal fade"
                                                                        id="edit{{ $list->id }}" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('SectionTranslation.edit_Section') }}
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form
                                                                                        action="{{ route('Sections.update', $list->id) }}"
                                                                                        method="POST">
                                                                                        {{ method_field('patch') }}
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                    name="Name_Section_Ar"
                                                                                                    class="form-control"
                                                                                                    value="{{ $list->getTranslation('name', 'ar') }}">

                                                                                                @error('Name_Section_Ar')
                                                                                                    <small
                                                                                                        class="form-text text-danger">{{ $message }}</small>
                                                                                                @enderror
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                    name="Name_Section_En"
                                                                                                    class="form-control"
                                                                                                    value="{{ $list->getTranslation('name', 'en') }}">

                                                                                                @error('Name_Section_En')
                                                                                                    <small
                                                                                                        class="form-text text-danger">{{ $message }}</small>
                                                                                                @enderror
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('SectionTranslation.Name_Grade') }}</label>
                                                                                            <select name="Grade_id"
                                                                                                class="custom-select"
                                                                                                onclick="console.log($(this).val())">
                                                                                                <!--placeholder-->
                                                                                                <option
                                                                                                    value="{{ $Grade->id }}">
                                                                                                    {{ $Grade->name }}
                                                                                                </option>

                                                                                                <option
                                                                                                    value="{{ $Grade->id }}">
                                                                                                    {{ $Grade->name }}
                                                                                                </option>

                                                                                            </select>

                                                                                            @error('Grade_id')
                                                                                                <small
                                                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('SectionTranslation.Select_class') }}</label>
                                                                                            <select name="Class_id"
                                                                                                class="custom-select">

                                                                                                <option
                                                                                                    value="{{ $list->classrooms->id }}">
                                                                                                    {{ $list->classrooms->name }}
                                                                                                </option>

                                                                                            </select>
                                                                                            @error('Class_id')
                                                                                                <small
                                                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <div class="form-check">

                                                                                                <input type="checkbox"
                                                                                                    data-status="{{ $list->status }}"
                                                                                                    {{ $list->status == 1 ? 'checked' : null }}
                                                                                                    class=" form-check-input"
                                                                                                    name="status"
                                                                                                    id="exampleCheck1">



                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="exampleCheck1">{{ trans('SectionTranslation.status') }}</label>
                                                                                            </div>
                                                                                        </div>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('GradesTranslation.Close') }}</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">{{ trans('GradesTranslation.Save') }}</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- delete_modal_Grade -->
                                                                    <div class="modal fade"
                                                                        id="delete{{ $list->id }}" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                        class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('SectionTranslation.delete_Section') }}
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('Sections.destroy', $list->id) }}"
                                                                                        method="post">
                                                                                        {{ method_field('Delete') }}
                                                                                        @csrf
                                                                                        {{ trans('SectionTranslation.Warning_Section') }}
                                                                                        <input id="id"
                                                                                            type="hidden"
                                                                                            name="id"
                                                                                            class="form-control"
                                                                                            value="">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('GradesTranslation.Close') }}</button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-danger">{{ trans('GradesTranslation.Save') }}</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                        @endforeach
                    </div>
                </div>

                <!--اضافة قسم جديد -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                    id="exampleModalLabel">
                                    {{ trans('SectionTranslation.add_section') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="Name_Section_Ar" class="form-control"
                                                placeholder="{{ trans('SectionTranslation.Section_name_ar') }}">

                                            @error('Name_Section_Ar')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <input type="text" name="Name_Section_En" class="form-control"
                                                placeholder="{{ trans('SectionTranslation.Section_name_en') }}">

                                            @error('Name_Section_En')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <br>


                                    <div class="col">
                                        <label for="inputName"
                                            class="control-label">{{ trans('SectionTranslation.Name_Grade') }}</label>
                                        <select name="Grade_id" class="custom-select"
                                            onchange="console.log($(this).val())">
                                            <!--placeholder-->

                                            <option value="" selected disabled>
                                                {{ trans('SectionTranslation.Select_Grade') }}
                                            </option>
                                            @foreach ($list_grades as $Grade)
                                                <option value="{{ $Grade->id }}">
                                                    {{ $Grade->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('Grade_id')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="inputName"
                                            class="control-label">{{ trans('SectionTranslation.Name_Class') }}</label>
                                        <select name="Class_id" class="custom-select">

                                        </select>

                                        @error('Class_id')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('GradesTranslation.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-danger">{{ trans('GradesTranslation.Save') }}</button>
                            </div>
                            </form>
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
    <script>
        $(document).ready(function() {
            let check = $('.cheackStatus').attr('data-status');
            console.log(check);
            $('select[name="Grade_id"]').on('change', function() {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "/calses/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Class_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Class_id"]').append('<option value="' +
                                    key + '">' + value + '</option>');
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

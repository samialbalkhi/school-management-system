@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('TeachersTranslation.List_Teachers')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('TeachersTranslation.List_Teachers')}}
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
                                <a href="{{route('Teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('TeachersTranslation.Add_Teacher') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('TeachersTranslation.Name_Teacher')}}</th>
                                            <th>{{trans('TeachersTranslation.Gender')}}</th>
                                            <th>{{trans('TeachersTranslation.Joining_Date')}}</th>
                                            <th>{{trans('TeachersTranslation.specialization')}}</th>
                                            <th>{{ trans('GradesTranslation.proscesses') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                      
                                        @foreach($teacher as $teachers)
                                            <tr>
                                           
                                            <td>{{ $teachers->id }}</td>
                                            <td>{{$teachers->name}}</td>
                                            <td>{{$teachers->genders->name}}</td>
                                            <td>{{$teachers->joining_date}}</td>
                                            <td>{{$teachers->specializations->name}}</td>
                                                <td>
                                                    <a href="{{route('Teachers.edit',$teachers->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Teacher" title="{{ trans('GradesTranslation.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_Teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('Teachers.destroy',$teachers->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('TeachersTranslation.Delete_Teacher') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('GradesTranslation.Warning_Grade') }}</p>
                                                            <input type="hidden" name="id"  value="{{$teachers->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('GradesTranslation.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('GradesTranslation.Save') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
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
@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
    @section('title')
        إجراء اختبار
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        إجراء اختبار
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizze_id' => $id, 'student_id' => $StudentId])

@endsection
@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection
@extends('layouts.module._master_list')
@section('table-header')
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
@endsection
@section('table-title')
    Hover Data Table
@endsection
@section('data-list')
    <?php
    $module_name = "New Education";
    $module_dash = str_replace(" ", "-", strtolower($module_name));
    $module_udash = str_replace(" ", "_", strtolower($module_name));
    ?>
    <!-- Button to Open the Add User Modal -->
    <?php $mid = 'addEducation'; $mtitle = 'Add New Education'?>
    <button type="button" class="btn btn-primary" style=" border: 6px solid #fff;"
            data-toggle="modal" data-target="#modal_add_{{$module_udash}}">
        Add {{$module_name}}
    </button>
    <!-- Button to Open the Modal -->
    <!-- /.box-header -->
    <div class="box-body">

        <table id="listDataTable" class="table table-bordered table-hover display"
               style="width:100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Education</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!--script calling from list.js-->
    <input type="hidden" id="education_datatable" value="{{route('list-education-datatable')}}">
    <input type="hidden" id="education_create" value="{{route('education')}}">
    <input type="hidden" id="education_edit" value="{{route('education')}}">
    <input type="hidden" id="education_delete" value="{{route('education')}}">
    @push('modals')
        @include('modals.education.modals._add')
        @include('modals.education.modals._edit')
    @endpush

@endsection
@push('styles')
    {{ap_datepicker("css")}}
    {{ap_datatable("css")}}
@endpush
@push('scripts')
    <!-- DataTables -->
    {{ap_datatable("js")}}
    {{--ajax script--}}
    <script src="{{asset("resources/assets/backjs/education/list.js")}}"></script>
@endpush

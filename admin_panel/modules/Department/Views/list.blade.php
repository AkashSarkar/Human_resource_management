@extends('layouts.module._master_list')
<?php $module = "Department";?>
@section('head_title')
    {{$module}}
@endsection
@section('table-header')
    <section class="content-header">
        <h1>
            {{$module}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> {{$module}}</li>
        </ol>
    </section>
@endsection
@section('table-title')
   <h1>{{$module}}</h1>
@endsection
@section('data-list')
    <?php
    $module_name = 'New '.$module;
    $module_dash = str_replace(" ", "-", strtolower($module_name));
    $module_udash = str_replace(" ", "_", strtolower($module_name));
    ?>
    <!-- Button to Open the Add User Modal -->
    <?php $mid = 'adddepartment'; $mtitle = 'Add New department Item'?>
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
                <th>Department</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!--script calling from list.js-->
    <input type="hidden" id="department_datatable" value="{{route('list-department-datatable')}}">
    <input type="hidden" id="department_create" value="{{route('department')}}">
    <input type="hidden" id="department_edit" value="{{route('department')}}">
    <input type="hidden" id="department_delete" value="{{route('department')}}">
    @push('modals')
        @include('modals.department.modals._add')
        @include('modals.department.modals._edit')
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
    <script src="{{asset("resources/assets/backjs/department/list.js")}}"></script>
@endpush

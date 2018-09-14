@extends('layouts.module._master_list')
<?php $module = "Attendance";?>
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
    $module=$module;
    $module_prefix=strtolower($module);
    ?>
    <!-- Button to Open the Add User Modal -->
    <?php $mid = 'addLeave'; $mtitle = 'Add New Leave Types'?>

    <!-- Button to Open the Modal -->
    <!-- /.box-header -->
    <div class="box-body">
        <h4>{{date(now())}}</h4>
        <table id="listDataTable" class="table table-bordered table-hover display"
               style="width:100%">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Employee Name</th>
                <th>Attendance</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!--script calling from list.js-->
    <input type="hidden" id="{{$module_prefix}}_datatable" value="{{route('list-'.$module_prefix.'-datatable')}}">
    <input type="hidden" id="{{$module_prefix}}_create" value="{{route($module_prefix)}}">
    <input type="hidden" id="{{$module_prefix}}_edit" value="{{route($module_prefix)}}">
    <input type="hidden" id="{{$module_prefix}}_delete" value="{{route($module_prefix)}}">


@endsection
@push('styles')
    {{ap_datepicker("css")}}
    {{ap_datatable("css")}}
@endpush
@push('scripts')
    <!-- DataTables -->
    {{ap_datatable("js")}}
    {{--ajax script--}}
    <script src="{{asset("resources/assets/backjs/Attendance/".$module_prefix."/list.js")}}"></script>
@endpush

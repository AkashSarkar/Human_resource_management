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
    $module_name = "New Industry";
    $module_dash = str_replace(" ", "-", strtolower($module_name));
    $module_udash = str_replace(" ", "_", strtolower($module_name));
    ?>
    <!-- Button to Open the Add User Modal -->
    <?php $mid = 'addIndustry'; $mtitle = 'Add New Industry'?>
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
                <th>Industry</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!--script calling from list.js-->
    <input type="hidden" id="industry_datatable" value="{{route('list-industry-datatable')}}">
    <input type="hidden" id="industry_create" value="{{route('industry')}}">
    <input type="hidden" id="industry_edit" value="{{route('industry')}}">
    <input type="hidden" id="industry_delete" value="{{route('industry')}}">
    @push('modals')
        @include('modals.industry.modals._add')
        @include('modals.industry.modals._edit')
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
    <script src="{{asset("resources/assets/backjs/industry/list.js")}}"></script>
@endpush

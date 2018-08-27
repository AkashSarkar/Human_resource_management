@extends('layouts.module._master_list')
@section('head_title')
    Notice Board
@endsection
@section('table-header')
    <section class="content-header">
        <h1>
            Notice Board
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Notice</li>
        </ol>
    </section>
@endsection
@section('table-title')
    <h1>Notice Board</h1>
@endsection
@section('data-list')
    <?php
    $module_name = "New Notice";
    $module_dash = str_replace(" ", "-", strtolower($module_name));
    $module_udash = str_replace(" ", "_", strtolower($module_name));
    ?>
    <!-- Button to Open the Add User Modal -->
    <?php $mid = 'addNotice'; $mtitle = 'Add New Notice'?>
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
                <th>Title</th>
                <th>Description</th>
                <th>Created On</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!--script calling from list.js-->
    <input type="hidden" id="notice_datatable" value="{{route('list-notice-datatable')}}">
    <input type="hidden" id="notice_create" value="{{route('notice')}}">
    <input type="hidden" id="notice_edit" value="{{route('notice')}}">
    <input type="hidden" id="notice_delete" value="{{route('notice')}}">
    @push('modals')
        @include('modals.notice.modals._add')
        @include('modals.notice.modals._edit')
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
    <script src="{{asset("resources/assets/backjs/notice/list.js")}}"></script>
@endpush

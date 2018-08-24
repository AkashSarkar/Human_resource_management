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
    $module_name = "New User";
    $module_dash = str_replace(" ", "-", strtolower($module_name));
    $module_udash = str_replace(" ", "_", strtolower($module_name));
    ?>
    <!-- Button to Open the Add User Modal -->
    <?php $mid = 'addUser'; $mtitle = 'Add New User'?>
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
                <th> id</th>
                <th> Hash</th>
                <th> First Name</th>
                <th> Last Lame</th>
                <th> Gender</th>
                <th> Date Of Birth</th>
                <th> Status</th>
                <th> Role</th>
                <th> Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
                <th> id</th>
                <th> Hash</th>
                <th> First Name</th>
                <th> Last Lame</th>
                <th> Gender</th>
                <th> Date Of Birth</th>
                <th> Status</th>
                <th> Role</th>
                <th> Action</th>
            </tr>
            </tfoot>

        </table>
    </div>
  <!--script calling from list.js-->
    <input type="hidden" id="user_datatable" value="{{route('list-user-datatable')}}">
    <input type="hidden" id="user_create" value="{{route('create-user')}}">
    <input type="hidden" id="user_edit" value="{{route('edit-user')}}">
    <input type="hidden" id="user_delete" value="{{route('delete-user')}}">
    <input type="hidden" id="role_user" value="{{route('role-user')}}">
    @push('modals')
        @include('modals.user.modals._add')
        @include('modals.user.modals._edit')
    @endpush
@endsection
@push('styles')
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush
@push('scripts')
    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    {{--ajax script--}}
    <script src="{{asset("resources/assets/backjs/user/list.js")}}"></script>
@endpush

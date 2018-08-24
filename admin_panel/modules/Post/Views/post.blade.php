@extends('layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Tables
                <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Hover Data Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> id</th>
                                    <th> Hash</th>
                                    <th> Post Data</th>
                                    <th> Post Type</th>
                                    <th> User</th>
                                    <th> Created At</th>
                                    <th> Updated At</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->hash_id }}</td>
                                        <td>{{ $post->post_data }}</td>
                                        <td>{{ $post->post_type_id }}</td>
                                        <td>{{ $post->user_id }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at}}</td>
                                    </tr>
                                @endforeach


                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!--script calling from list.js-->
    <input type="hidden" id="post_data" value="/post-data">

@endsection
@push('scripts')
    <script src="{{asset("resources/assets/backjs/post/list.js")}}"></script>
@endpush
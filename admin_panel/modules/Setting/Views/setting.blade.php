@extends('layouts.module._master_list')
@section('table-header')
    <section class="content-header">
        <h1>
            Setting Data Tables
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Setting</li>
        </ol>
    </section>
@endsection
@section('table-title')

@endsection
@section('data-list')
    <ul class="nav nav-pills mb-3" style="margin-bottom: 4px;padding: 4px;" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link ac" id="post-tab" data-toggle="pill" href="#post" role="tab" aria-controls="post" aria-selected="true">Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="pill" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent" style="padding: 4px;">
        <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="post-tab">
                <table id="settingPost" class="table table-bordered table-hover">
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
                        <tr id="{{$post->id}}">
                            <td class="row_data {{$post->id}}" contenteditable="true" name="id">{{ $post->id }}</td>
                            <td class="row_data {{$post->id}}" contenteditable="true" name="hash_id">{{ $post->hash_id }}</td>
                            <td class="row_data {{$post->id}}" contenteditable="true"
                                name="post_data">{{ $post->post_data }}</td>
                            <td class="row_data {{$post->id}}" contenteditable="true"
                                name="post_type_id">{{ $post->post_type_id }}</td>
                            <td class="row_data {{$post->id}}" contenteditable="true" name="user_id">{{ $post->user_id }}</td>
                            <td class="row_data {{$post->id}}" contenteditable="true"
                                name="created_at">{{ $post->created_at }}</td>
                            <td class="row_data {{$post->id}}" contenteditable="true"
                                name="updated_at">{{ $post->updated_at}}</td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        <div class="modal-footer">

            <button type="button" class="btn btn-success save">Save</button>
            <button type="button" class="btn btn-danger">Cancel</button>
        </div>
    </div>


    <?php
    $module_name = "Setting Update";
    $module_dash = str_replace(" ", "-", strtolower($module_name));
    $module_udash = str_replace(" ", "_", strtolower($module_name));
    ?>

    <input type="hidden" id="setting" value="{{route('edit-setting')}}">
    <!-- /.content -->
    <!--script calling from list.js-->
    {{--<input type="hidden" id="post_data" value="/post-data">--}}

@endsection
@push('scripts')
    <script src="{{asset("resources/assets/backjs/setting/list.js")}}"></script>
@endpush
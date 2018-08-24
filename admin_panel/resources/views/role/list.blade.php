@extends('layout.admintamplate')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <?php if (Session::get('success_message') != "") { ?>
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>

                    {{ Session::get('success_message') }}
                </div>
                <?php } ?>
                <div class="panel-heading">
                    <div class="panel-title"><h4>Role List</h4></div>
                </div>
                <div class="panel-body">

                    <div class="overflow-table-edited">
                        <table class="display datatables-basic table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roledata as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->role_name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td class="text-right">
{{--                                        {{anchor_edit(null,"get-role",null,null,null,array('title' => "", 'class' => "btn btn-default dim"))}}--}}
{{--                                        @if($this->perm_uri["get-role"])--}}
                                            <a class="btn btn-xs btn-edit-content"
                                               data-toggle="modal"
                                               onclick="getroledata({{$role->id}})"
                                               data-target="#modal_edit_role">
                                                <i class="dropdown-icon fa fa-pencil"></i>
                                            </a>
                                        {{--@endif--}}
                                        @if($role->need_access && $role->extra_access)
                                            <a data-sync="{{$role->id}}"
                                               onclick='syncNeedExtra({{$role->id}})'
                                               class="btn btn-xs btn-edit-content"
                                               data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Sync Permission">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </a>
                                        @elseif($role->need_access)
                                            <a data-sync="{{$role->id}}"
                                               onclick='syncNeed({{$role->id}})'
                                               class="btn btn-xs btn-edit-content"
                                               data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Sync Permission">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </a>
                                        @elseif($role->extra_access)
                                            <a data-sync="{{$role->id}}"
                                               onclick='syncExtra({{$role->id}})'
                                               class="btn btn-xs btn-edit-content"
                                               data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Sync Permission">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--add product model-->
    <div class="modal fade full-height" id="modal_add_role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Role</h4>
                </div>
                <div class="modal-body">
                    <div class="box-content nopadding" id="content_box">
                        <div class="form-group">
                            <label class="control-label col-md-3">Role Name</label>
                            <div class="input-group col-md-8">
                                <input type="text" class="form-control" name="role_name" id="role_name"
                                       placeholder="Enter Role Name" autocomplete="off" value="{{old('role_name')}}"
                                       required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="input-group col-md-8">
                                <textarea name="description" id="description" placeholder="Enter Role Description"
                                          class="form-control" rows="3" required>{{old('description')}}</textarea>
                            </div>
                        </div>

                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                    <button type="button" id="add_user_btn" onclick="addRole()" class="btn btn-primary">ADD</button>
                </div>
                <input type="hidden" id="create_role_url" value="{{url('/create-role')}}">
            </div>
        </div>
    </div><!--.modal-->



    <div class="modal fade full-height" id="modal_edit_role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Role</h4>
                </div>
                <div class="modal-body">
                    <div class="box-content nopadding" id="content_box_edit">
                        <label class="control-label col-md-3">Role Name</label>
                        <div class="form-group">
                            <div class="input-group col-md-8">
                                <input type="text" class="form-control" name="role_name_edit" id="role_name_edit"
                                       placeholder="Enter Role Name" autocomplete="off" value="{{old('role_name')}}"
                                       required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="input-group col-md-8">
                                <textarea name="description_edit" id="description_edit"
                                          placeholder="Enter Role Discription" class="form-control" rows="3"
                                          required>{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                    <button type="button" id="add_user_btn" onclick="editRole()" class="btn btn-primary">UPDATE</button>
                </div>
                <input type="hidden" id="get_role_url" value="{{url('/get-role')}}">
                <input type="hidden" id="edit_role_url" value="{{url('/edit-role')}}">
                <input type="hidden" id="id_of_edit">
            </div>
        </div>
    </div><!--.modal-->

    <script>
        function syncNeedExtra(role_id) {
            sync(role_id, "<b>create</b> and <b>deleted</b>")
        }

        function syncNeed(role_id) {
            sync(role_id, "<b>create</b>")
        }

        function syncExtra(role_id) {
            sync(role_id, "<b>deleted</b>")
        }

        function sync(role_id, message) {
            $.confirm({
                title: "Confirm!!!",
                content: "This permission's data will be " + message + " if you synchronize.You really want to synchronize?",
                buttons: {
                    confirm: function () {
                        $.ajax({
                            url: $("#base_url").val() +"/permissions-sync/" + role_id,
                            cache: false,
                            statusCode: customStatusCodeRes,
                            success: function (res, textStatus, jqXHR) {
                                console.log(res);
                                $("[data-sync='" + role_id + "']").remove();
                            }
                        });
                        return true;
                    },
                    cancel: function () {
                    }
                }
            });
        }
    </script>

    <script src="{{ asset('resources/assets/backjs/roleJs.js')}}"></script>



@stop
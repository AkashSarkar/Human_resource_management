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
                <div class="panel-title"><h4>Permission List</h4></div>
                <!--<button class="btn btn-indigo" data-toggle="modal" data-target="#modal_add_role">Add Role</button>-->
            </div>
            <div class="panel-body">

                <div class="overflow-table-edited">
                    <table class="display datatables-basic">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>URL</th>
                                <th>Module Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>URL</th>
                                <th>Module Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            <?php
                            foreach ($permissiondata as $permission):
                                ?>
                                <tr>
                                    <td><?php echo $permission['id']; ?></td>
                                    <td><?php echo $permission['route_url']; ?></td>
                                    <td><?php echo $permission['module_name']; ?></td>
                                    <td><?php echo $permission['description']; ?></td>
                                    <!--<td><?php // echo $role['created_by'];   ?></td>-->
                                    <!--<td><?php // echo $role['created_at'];   ?></td>-->
                                    <td>
                                        <button class="btn btn-primary btn-xs dt-edit" data-toggle="modal" onclick="getpermissiondata(<?php echo $permission['id']; ?>)" data-target="#modal_edit_permission"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <!--<a onClick="javascript: return confirm('Please confirm deletion');" href="{{url('delete-role')}}/<?php // echo $role['id'];  ?>"><button class="btn btn-danger btn-xs dt-delete"><span class="glyphicon glyphicon-trash"></span></button></a>-->
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!--add product model-->
<!--<div class="modal fade full-height" id="modal_add_role" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Enter Role Name" autocomplete="off" value="{{old('role_name')}}" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="input-group col-md-8">
                            <textarea name="description" id="description" placeholder="Enter Role Description" class="form-control" rows="3" required>{{old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                <button type="button" id="add_user_btn" onclick="addRole()" class="btn btn-primary">ADD</button>
            </div>
            <input type="hidden" id="create_role_url" value="{{url('/create-role')}}">
        </div>
    </div>
</div>.modal-->



<div class="modal fade full-height" id="modal_edit_permission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Permission</h4>
            </div>
            <div class="modal-body">
                <div class="box-content nopadding" id="content_box_edit">
                    <div class="form-group">
                        <label class="control-label col-md-3">Id</label>
                        <div class="input-group col-md-8" name="permission_id_edit" id="permission_id_edit">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">URL</label>
                        <div class="input-group col-md-8" name="permission_url_edit" id="permission_url_edit">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Module Name</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="module_name_edit" id="module_name_edit" placeholder="Enter Module Name" autocomplete="off" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="input-group col-md-8">
                            <textarea name="description_edit" id="description_edit" placeholder="Enter Role Discription" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                <button type="button" id="add_user_btn" onclick="editPermission()" class="btn btn-primary">UPDATE</button>
            </div>
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="get_permission_url" value="{{url('/get-permission')}}">
            <input type="hidden" id="edit_permission_url" value="{{url('/edit-permission')}}">
            <input type="hidden" id="id_of_edit">
        </div>
    </div>
</div><!--.modal-->



<script src="{{ asset('resources/assets/backjs/permissionJs.js')}}"></script>



@stop
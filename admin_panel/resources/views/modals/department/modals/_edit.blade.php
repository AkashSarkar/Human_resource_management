@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module_name}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="e_first_name" name="e_first_name"
                           placeholder="First Name"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_first_name"></span>
                    <span id="hello"></span>
                </div>
                <div class="form-group">
                    <label for="Last Name">Last Name</label>
                    <input type="text" class="form-control" id="e_last_name" name="e_last_name" placeholder="Last Name"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_last_name"></span>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="e_gender" name="e_gender" placeholder="gender"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_e_gender"></span>
                </div>
                <div class="form-group">
                    <label>Date of Birth :</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="e_dob" name="e_dob">
                    </div>
                    <span class="help-block error eMsg_e_dob"></span>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    {{--<input type="text" class="form-control" id="e_status" name="e_status" placeholder="Status"
                           autocomplete="off" required="required">--}}
                    <div>
                        <select class="form-control " style="width: 58rem;" id="e_status">
                            <option value="1">True</option>
                            <option value="0">False</option>
                        </select>
                    </div>
                    <span class="help-block error eMsg_e_status"></span>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    {{--<input type="text" class="form-control" id="e_role_id" name="e_role_id" placeholder="Role Id"--}}
                           {{--autocomplete="off" required="required">--}}
                    <select class="form-control " style="width: 58rem;" id="e_role_id">
                    </select>
                    <span class="help-block error eMsg_e_role_id"></span>
                </div>


            </div>
            <!-- /.box-body -->
        </form>
    </div>
    <script>
        var module_udash = "{{$module_udash}}"
        var module_dash = "{{$module_dash}}";
        var edit_form_id = "{{$form_id}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="e{{$module_dash}}">CANCEL</button>
    <button type="button" class="btn btn-primary" id="edit-{{$module_dash}}-btn">Update</button>
@overwrite
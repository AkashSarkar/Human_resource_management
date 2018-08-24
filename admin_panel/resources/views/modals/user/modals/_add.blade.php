{{--@extends("modals.post._master_modal")--}}
{{--@section('modal-id'){{$mid}}@endsection--}}
{{--@section('modal-title'){{$mtitle}}@endsection--}}
{{--@section('modal-form')--}}
{{--<!-- form start -->--}}
{{--<form role="form">--}}
{{--<div class="box-body">--}}
{{--<div class="form-group">--}}
{{--<label for="firstName">First Name</label>--}}
{{--<input type="" class="form-control" id="fname" placeholder="First Name">--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label for="Last Name">Last Name</label>--}}
{{--<input type="" class="form-control" id="lname" placeholder="Last Name">--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label for="gender">Gender</label>--}}
{{--<input type="" class="form-control" id="gender" placeholder="gender">--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label>Date of Birth :</label>--}}

{{--<div class="input-group date">--}}
{{--<div class="input-group-addon">--}}
{{--<i class="fa fa-calendar"></i>--}}
{{--</div>--}}
{{--<input type="date" class="form-control pull-right" id="dob">--}}
{{--</div>--}}
{{--<!-- /.input group -->--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label for="status">Status</label>--}}
{{--<input type="" class="form-control" id="status" placeholder="Status">--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label for="role">Role</label>--}}
{{--<input type="" class="form-control" id="role" placeholder="Role Id">--}}
{{--</div>--}}


{{--</div>--}}
{{--<!-- /.box-body -->--}}
{{--</form>--}}
{{--@endsection--}}
{{--@section('modal-footer-action')--}}
{{--<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">CANCEL</button>--}}
{{--<button type="submit" class="btn btn-primary" onclick="addUser()">Submit</button>--}}
{{--@endsection--}}

@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_add_".$module_udash}}@overwrite
@section('modal-title'){{"Add ".$module_name}}@overwrite
<?php $form_id = "add-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_first_name"></span>
                </div>
                <div class="form-group">
                    <label for="Last Name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_last_name"></span>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" placeholder="gender"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_gender"></span>
                </div>
                <div class="form-group">
                    <label>Date of Birth :</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="dob" name="dob">
                    </div>
                    <span class="help-block error eMsg_dob"></span>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label for="status">Status</label>{{--
                    <input type="text" class="form-control" id="status" name="status" placeholder="Status"
                           autocomplete="off" required="required">--}}
                    <div>
                        <select class="form-control " style="width: 58rem;" id="status">
                            <option value="1">True</option>
                            <option value="0">False</option>
                        </select>
                    </div>
                    <span class="help-block error eMsg_status"></span>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                  {{--  <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Role Id"
                           autocomplete="off" required="required">--}}
                    <select class="form-control " style="width: 58rem;" id="role_id">
                    </select>
                    <span class="help-block error eMsg_role_id"></span>
                </div>


            </div>
            <!-- /.box-body -->
        </form>
    </div>
    <script>
        var module_udash = "{{$module_udash}}"
        var module_dash = "{{$module_dash}}";
        var add_form_id = "{{$form_id}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="{{$module_dash}}">CANCEL</button>
    <button type="button" class="btn btn-primary" id="add-{{$module_dash}}-btn">Add {{$module_name}}</button>
@overwrite
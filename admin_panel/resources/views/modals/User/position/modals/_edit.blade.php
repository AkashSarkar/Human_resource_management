@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                {{--{--Employee id--}}
                <?php $input_name = "e_employee_id"; $place_holder="Employee id";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Department id--}}
                <?php $input_name = "e_department"; $place_holder="Department";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Designation --}}
                <?php $input_name = "e_designation"; $place_holder="Designation";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--date of joining--}}
                <?php $input_name = "e_date_of_joining";$place_holder="Date of joining";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="date" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--date of exit--}}
                <?php $input_name = "e_date_of_exit";$place_holder="Date of exit";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="date" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--salary--}}
                <?php $input_name = "e_salary";$place_holder="Salary";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="number" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--status--}}
                <?php $input_name = "e_status"; $place_holder="Status";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                        <option value="true">Active</option>
                        <option value="false">Inactive</option>
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>
    <script>
        var module_udash = "{{$module_udash}}"
        var module_dash = "{{$module_dash}}";
        var edit_form_id = "{{$form_id}}";
        var module_prefix="{{$module_prefix}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="e{{$module_dash}}">CANCEL</button>
    <button type="button" class="btn btn-primary" id="edit-{{$module_dash}}-btn">Update</button>
@overwrite
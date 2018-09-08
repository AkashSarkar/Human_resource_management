@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_add_".$module_udash}}@overwrite
@section('modal-title'){{"Add ".$module_name}}@overwrite
<?php $form_id = "add-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">

                {{--Employee id--}}
                <?php $input_name = "employee_id"; $place_holder="Employee id";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Department id--}}
                <?php $input_name = "department"; $place_holder="Department";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                        <option value="">Select Designation</option>
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Designation --}}
                <?php $input_name = "designation"; $place_holder="Designation";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                    </select>
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--date of joining--}}
                <?php $input_name = "date_of_joining";$place_holder="Date of joining";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="date" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>


                {{--date of exit--}}
                <?php $input_name = "date_of_exit";$place_holder="Date of exit";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="date" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--salary--}}
                <?php $input_name = "salary";$place_holder="Salary";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="number" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--status--}}
                <?php $input_name = "status"; $place_holder="Status";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                        <option value="True">Active</option>
                        <option value="False">Inactive</option>
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
        var add_form_id = "{{$form_id}}";
        var module_prefix = "{{$module_prefix}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="{{$module_dash}}">CANCEL</button>
    <button type="button" class="btn btn-primary" id="add-{{$module_dash}}-btn">Add {{$module_name}}</button>
@overwrite
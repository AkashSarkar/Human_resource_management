@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{$module}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                {{--Employee id--}}
                <?php $input_name = "status"; $place_holder="Status";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <select class="form-control " style="width: 58rem;" id="{{$input_name}}">
                        <option value="pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                        <option></option>
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
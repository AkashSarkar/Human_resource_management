@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module_name}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="e_company" name="e_company"
                           placeholder="Company"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_company"></span>
                    <span id="hello"></span>
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
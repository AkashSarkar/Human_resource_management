@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module_name}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="e_department">Department</label>
                    <input type="text" class="form-control" id="e_department" name="e_department" placeholder="Department"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_e_department"></span>
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <br>
                    <p id="n_e_des"></p>
                    <a href="#" class="text-bold btn-sm btn-success" id="add_e_des"> + Add more designation</a>
                    <span class="help-block error eMsg_e_designation"></span>
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
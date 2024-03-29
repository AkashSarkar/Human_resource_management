@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="e_title">Title</label>
                    <input type="text" class="form-control" id="e_title" name="e_title"
                           placeholder="Title"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_title"></span>
                    <span id="hello"></span>
                </div>
                <div class="form-group">
                    <label for="e_description">Description</label>
                    <input type="text" class="form-control" id="e_description" name="e_description"
                           placeholder="Description"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_description"></span>

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
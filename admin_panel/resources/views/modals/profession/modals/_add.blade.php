@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_add_".$module_udash}}@overwrite
@section('modal-title'){{"Add ".$module_name}}@overwrite
<?php $form_id = "add-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="profession">Profession</label>
                    <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_profession"></span>
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
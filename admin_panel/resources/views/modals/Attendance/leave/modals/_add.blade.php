@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_add_".$module_udash}}@overwrite
@section('modal-title'){{"Add ".$module_name}}@overwrite
<?php $form_id = "add-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                {{--Leave type--}}
                <?php $input_name = "leave";$place_holder="Leave Type";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
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
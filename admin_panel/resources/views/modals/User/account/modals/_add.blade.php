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


                {{--account_name--}}
                <?php $input_name = "account_name"; $place_holder="Account Name";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--account_number--}}
                <?php $input_name = "account_number";$place_holder="Account Number";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="number" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--bank_name--}}
                <?php $input_name = "bank_name";$place_holder="Bank Name";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--ifsc --}}
                <?php $input_name = "ifsc";$place_holder="IFSC Code"?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--pan_number--}}
                <?php $input_name = "pan_number";$place_holder="Pan Number";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="number" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--branch--}}
                <?php $input_name = "branch";$place_holder="Branch";?>
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
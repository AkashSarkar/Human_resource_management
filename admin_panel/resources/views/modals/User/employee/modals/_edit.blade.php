@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                {{--name--}}
                <?php $input_name = "e_name"; $place_holder="Name";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--email--}}
                <?php $input_name = "e_email";$place_holder="Email";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="email" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--password--}}
                <?php $input_name = "e_password";$place_holder="New Password";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Father name--}}
                <?php $input_name = "e_f_name";$place_holder="Father Name"?>
                <div class="form-group">
                    <label for="{{$input_name}}">Father name</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Phone--}}
                <?php $input_name = "e_phone";$place_holder="Phone";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="number" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--date of birth--}}
                <?php $input_name = "e_dob";$place_holder="Date of birth";?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="date" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--parmanent address--}}
                <?php $input_name = "e_p_address";$place_holder="Permanent address"?>
                <div class="form-group">
                    <label for="{{$input_name}}">{{$place_holder}}</label>
                    <input type="text" class="form-control" id="{{$input_name}}" name="{{$input_name}}"
                           placeholder="{{$place_holder}}"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_{{$input_name}}"></span>
                </div>

                {{--Local address--}}
                <?php $input_name = "e_l_address";$place_holder="Local address"?>
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
        var edit_form_id = "{{$form_id}}";
        var module_prefix="{{$module_prefix}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="e{{$module_dash}}">CANCEL</button>
    <button type="button" class="btn btn-primary" id="edit-{{$module_dash}}-btn">Update</button>
@overwrite
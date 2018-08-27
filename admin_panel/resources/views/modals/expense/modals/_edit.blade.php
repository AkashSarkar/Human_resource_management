@extends("layouts.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module_name}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="box-body">
                <div class="form-group">
                    <label for="e_item">Item Name</label>
                    <input type="text" class="form-control" id="e_item" name="e_item"
                           placeholder="Item Name"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_item"></span>

                </div>
                <div class="form-group">
                    <label for="purchase">Purchase From</label>
                    <input type="text" class="form-control" id="e_purchase" name="e_purchase"
                           placeholder="purchase"
                           autocomplete="off" required="required" maxlength="128">
                    <span class="help-block error eMsg_e_purchase"></span>

                </div>
                <div class="form-group">
                    <label for="date">Purchase Date</label>
                    <input type="date" class="form-control" id="e_date" name="e_date"
                           placeholder="Purchase Date"
                           autocomplete="off" required="required" >
                    <span class="help-block error eMsg_e_date"></span>

                </div>
                <div class="form-group">
                    <label for="e_price">Price</label>
                    <input type="text" class="form-control" id="e_price" name="e_price"
                           placeholder="Item Name"
                           autocomplete="off" required="required">
                    <span class="help-block error eMsg_e_price"></span>

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
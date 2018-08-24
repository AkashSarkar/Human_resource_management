@extends("modals.post._master_modal")
@section('modal-id'){{"modal_add_".$module_udash}}@overwrite
@section('modal-title'){{"Add ".$module_name}}@overwrite
<?php $form_id = "add-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="form-group">
                <label class="control-label col-md-3">Label</label>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="label" id="label"
                           placeholder="Enter Label" autocomplete="off" required="required"
                           maxlength="128"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">URI Name</label>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="uri_name" id="uri_name"
                           placeholder="Enter Uri Name" autocomplete="off" required="required"
                    />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">URL</label>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="url" id="url"
                           placeholder="Enter Url" autocomplete="off" required="required"
                    />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Parent</label>
                <div class="input-group col-md-8" id="add_cat_tree_parent_div">
                    <div id="add_cat_tree" data-toggle="tree" data-tree-checkbox data-tree-select="1">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="get_category_url_for_add" value="{{route('get-menu-admin-for-add')}}">
    <script>
        var add_form_id = "{{$form_id}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">CANCEL</button>
    <button type="button" class="btn btn-primary" id="add-menu-admin-btn">SAVE</button>
@overwrite
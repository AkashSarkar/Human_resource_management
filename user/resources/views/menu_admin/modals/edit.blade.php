@extends("layout.module._master_modal")
@section('modal-id'){{"modal_edit_".$module_udash}}@overwrite
@section('modal-title'){{"Edit ".$module_name}}@overwrite
<?php $form_id = "edit-" . $module_dash . "-form"; ?>
@section('modal-form')
    <div class="box-content nopadding">
        <form id="{{$form_id}}" class="form-horizontal" role="form" onsubmit="javascripts(0)">
            <div class="form-group">
                <label class="control-label col-md-3">Label</label>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="label" id="label"
                           {{--                           value="{{ old('label',  isset($data->label) ? $data->label : null) }}"--}}
                           placeholder="Enter Label" autocomplete="off" required="required"
                           maxlength="128"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">URI Name</label>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="uri_name" id="uri_name"
                           {{--value="{{ old('uri_name',  isset($data->uri_name) ? $data->uri_name : null) }}"--}}
                           placeholder="Enter Uri Name" autocomplete="off" required="required"
                    />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">URL</label>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="url" id="url"
                           {{--                           value="{{ old('url',  isset($data->url) ? $data->url : null) }}"--}}
                           placeholder="Enter Url" autocomplete="off" required="required"
                    />
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label col-md-3">Parent</label>
                <div class="input-group col-md-8" id="cat_tree_parent_div">
                    <div id="cat_tree" data-tree-checkbox data-tree-select="1">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="get_category_url_for_id" value="{{$category_url_for_id}}">
    <input type="hidden" id="get_category_url_for_edit" value="{{route('get-menu-admin-for-edit')}}">
    <input type="hidden" id="edit_category_url" value="{{url('/edit-menu-admin')}}">
    <script>
        var edit_form_id = "{{$form_id}}";
    </script>
@overwrite
@section('modal-footer-action')
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">CANCEL</button>
    <button type="button" class="btn btn-primary" id="edit-{{$module_dash}}-btn">UPDATE</button>
@overwrite
<?php
/**
 * Created by PhpStorm.
 * User: jihad
 * Date: 11/8/17
 * Time: 10:24 AM
 */
?>
<?php
$module_name = "Menu Admin";
$module_dash = str_replace(" ", "-", strtolower($module_name));
$module_udash = str_replace(" ", "_", strtolower($module_name));
?>
@extends("layout.module._master_list")
@section("header-title",$module_name." List")
@section("header-action")
    @if($permObj["category"]["add"])
        <button class="btn btn-primary pull-right add-{{$module_dash}}-btn">
            <i class="fa fa-plus"></i> Add {{$module_name}}
        </button>
    @endif
@endsection
@push('content-header')
    <small>List</small>
@endpush
@section("data-table")

    <div class="table-responsive-row clearfix">
        <table id="table-category" class="table tableDnD category">
            <thead>
            <tr class="nodrag nodrop">
                <th class="fixed-width-xs center">
                    <span class="title_box">ID</span>
                </th>
                <th class="">
                    <span class="title_box">Name</span>
                </th>
                {{--<th class="">--}}
                {{--<span class="title_box">Description</span>--}}
                {{--</th>--}}
                <th class="fixed-width-xs center">
                    <span class="title_box center">Position</span>
                </th>
                <th class="fixed-width-xs center">
                    <span class="title_box">Displayed</span>
                </th>
                <th class="text-right">
                    <span class="title_box">Actions</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @if(count($categories))
                @foreach($categories as $category)
                    <tr id="tr_{{$category['id']}}" class=" {{($category['id']%2)?"odd":""}}">
                        <td
                                class="pointer fixed-width-xs center"
                                onclick="document.location = '{{url('list-menu-admin/' . $category['id'])}}'">
                            {{$category['id']}}
                        </td>
                        <td
                                class="pointer"
                                onclick="document.location = '{{url('list-menu-admin/' . $category['id'])}}'">
                            {{$category['label']}}
                        </td>
                        {{--<td class="pointer"></td>--}}
                        <td id="td_{{$category['id']}}" class="pointer dragHandle center">
                            <div class="dragGroup">
                                <div class="positions">
                                    {{$category['_sort']}}
                                </div>
                            </div>
                        </td>
                        <td class="pointer fixed-width-xs center">
                            <a class="list-action-enable ajax_table_link @if($category['status']==1) action-enabled @else action-disabled @endif"
                               href="javascript:void(0);"
                               data-btn-status="{{$category['id']}}"
                               data-status="{{$category['status']}}"
                               onclick="changeCatStatus({{$category['id']}})"
                               title="@if($category['status']==1) Enabled @else Disabled @endif">
                                @if($category['status']==1)
                                    <i class="icon-check"></i>
                                    <i class="icon-remove" style="display: none;"></i>
                                @else
                                    <i class="icon-check" style="display: none;"></i>
                                    <i class="icon-remove"></i>
                                @endif
                            </a>
                        </td>
                        <td class="text-right">
                            <div class="btn-group-action">
                                @if($permObj["category"]["edit"] || $permObj["category"]["delete"])
                                    @if($permObj["category"]["edit"])
                                        <div class="btn-group pull-right">
                                            <a class="btn btn-default edit-{{$module_dash}}-btn" title="View"
                                               data-id="{{$category['id']}}">
                                                <i class="fa fa-pencil"></i> Edit</a>
                                            </a>
                                            @endif
                                            @if($permObj["category"]["delete"])
                                                <button class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <i class="icon-caret-down"></i>&nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if($permObj["category"]["delete"])
                                                        <li>
                                                            <a title="Delete"
                                                               href="javascript:void(0);"
                                                               class="delete-{{$module_dash}}-btn"
                                                               data-id="{{$category['id']}}"
                                                            >
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>
                                    @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="list-empty">
                        <div class="list-empty-msg">
                            <i class="icon-warning-sign list-empty-icon"></i>
                            No records found
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection
@push('modals')
    @include('menu_admin.modals.add')
    @include('menu_admin.modals.edit')
    <div class="modal fade" id="modal_delete_category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Category <b><span id="delete_category_name_span"></span></b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </h4>

                </div>
                <div class="modal-body">
                    <div class="box-content clearfix nopadding" id="content_box">
                        <div class="form-group" style="color: red;">
                            All the sub-categories will be deleted automatically.
                        </div>
                        <div class="form-group">
                            Choose delete constrains:
                        </div>
                        <form id="delete_category_form">
                            <input type="hidden" name="id" id="delete_id">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <div class="radioer">
                                        <input type="radio" name="deleteMethod" id="optionsRadios2" value="2"
                                               checked>
                                        <label for="optionsRadios2">Only the categories will be deleted.</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">CANCEL</button>
                    <button type="button" id="add_user_btn" onclick="deleteCategory()" class="btn btn-primary">
                        DELETE
                    </button>
                </div>
                <input type="hidden" id="delete_menu_admin_url" value="{{url('/delete-menu-admin')}}">
            </div>
        </div>
    </div><!--.modal-->
    <input type="hidden" id="sort_categories" value="{{route('sort-menu-admin')}}">
    <input type="hidden" id="id_of_edit">
    <script>
        var module_dash = "{{$module_dash}}";
        var module_udash = "{{$module_udash}}";
    </script>
@endpush
@push('styles')
    {{ap_fancytree("css")}}
@endpush
@push('scripts')
    <script src="{{asset('resources/assets/globals/plugins/tablednd/jquery.tablednd.min.js')}}"></script>
    {{ap_fancytree("js")}}
    <script src="{{ asset('resources/assets/backjs/menu_admin/list.js')}}"></script>
@endpush


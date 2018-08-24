@extends('layout.admintamplate')

@section('content')
    <div class="alert alert_message alert-info alert-success  alert-fixed-top" style="display: none;">
        <strong class="alert_message_txt"> </strong>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <?php if (Session::get('success_message') != "") { ?>
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>

                    {{ Session::get('success_message') }}
                </div>
                <?php } ?>

                <div id="error_box">

                </div>

                <div class="panel-body">

                    <div class="overflow-table-edited">
                        <div class="col-md-12 permTabs">

                            <ul class="nav nav-tabs" role="tablist">
                                <?php foreach ($roles as $data) { ?>

                                <li class="@if ($data == reset($roles )) active @endif">
                                    <a href="#profile-<?php echo $data->id; ?>" id="profile-<?php echo $data->id; ?>"
                                       data-toggle="tab"
                                       class="nav-profile @if ($data == reset($roles )) active selected @endif">
                                        <?php echo $data->role_name; ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <form id="access_form" class="defaultForm form-horizontal col-lg-10"
                                  enctype="multipart/form-data" method="post"
                                  action="permissions/save?controller=AdminAccess&submitAddaccess=1&token={{ csrf_token() }}">
                                <div class="tab-content">
                                    <?php foreach ($roles as $data) { ?>
                                    <div class="tab-pane tab-profile profile-<?php echo $data->id; ?> @if ($data == reset($roles )) active @endif">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel-heading">
                                                    <div class="panel-title"><h4>{{$data->role_name}}</h4></div>
                                                </div>
                                                <div class="panel-body">

                                                    <table id="table_{{$data->id}}" class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Module Name</th>
                                                            <th>
                                                                <input type="checkbox"
                                                                       data-rel="-1||<?php echo $data->id; ?>||view||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>"
                                                                       class="viewall ajaxPower" name="1">
                                                                View
                                                            </th>
                                                            <th>
                                                                <input type="checkbox"
                                                                       data-rel="-1||<?php echo $data->id; ?>||add||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>"
                                                                       class="addall ajaxPower" name="1">
                                                                Add
                                                            </th>
                                                            <th>
                                                                <input type="checkbox"
                                                                       data-rel="-1||<?php echo $data->id; ?>||edit||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>"
                                                                       class="editall ajaxPower" name="1">
                                                                Edit
                                                            </th>
                                                            <th>
                                                                <input type="checkbox"
                                                                       data-rel="-1||<?php echo $data->id; ?>||delete||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>"
                                                                       class="deleteall ajaxPower" name="1">
                                                                Delete
                                                            </th>
                                                            <th>
                                                                <input type="checkbox"
                                                                       data-rel="-1||<?php echo $data->id; ?>||all||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>"
                                                                       class="allall ajaxPower" name="1">
                                                                All
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        if (!array_key_exists($data->id, $perms_data)) {
                                                            continue;
                                                        }
                                                        foreach ($perms_data[$data->id] as $perm_data) {
                                                        ?>
                                                        <tr class="parent">
                                                            <td class="bold">
                                                                <strong>>&nbsp;&nbsp;<?php echo $perm_data->module_name; ?></strong>
                                                            </td>
                                                            <td>
                                                                <input type="checkbox"
                                                                       <?php echo($perm_data->perm_view == 1 ? "checked='checked'" : ""); ?> class="ajaxPower view <?php echo $perm_data->id; ?>"
                                                                       data-rel="<?php echo $perm_data->id; ?>||<?php echo $perm_data->perm_role_id; ?>||view||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="checkbox"
                                                                       <?php echo($perm_data->perm_add == 1 ? "checked='checked'" : ""); ?>  class="ajaxPower add <?php echo $perm_data->id; ?>"
                                                                       data-rel="<?php echo $perm_data->id; ?>||<?php echo $perm_data->perm_role_id; ?>||add||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="checkbox"
                                                                       <?php echo($perm_data->perm_edit == 1 ? "checked='checked'" : ""); ?>  class="ajaxPower edit <?php echo $perm_data->id; ?>"
                                                                       data-rel="<?php echo $perm_data->id; ?>||<?php echo $perm_data->perm_role_id; ?>||edit||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="checkbox"
                                                                       <?php echo($perm_data->perm_delete == 1 ? "checked='checked'" : ""); ?>  class="ajaxPower delete <?php echo $perm_data->id; ?>"
                                                                       data-rel="<?php echo $perm_data->id; ?>||<?php echo $perm_data->perm_role_id; ?>||delete||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="checkbox"
                                                                       <?php echo($perm_data->perm_all == 1 ? "checked='checked'" : ""); ?>  class="ajaxPower all <?php echo $perm_data->id; ?>"
                                                                       data-rel="<?php echo $perm_data->id; ?>||<?php echo $perm_data->perm_role_id; ?>||all||<?php echo $total_perm + 1; ?>||<?php echo $total_perm; ?>">
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')

    <script type="text/javascript">

        $(document).ready(function () {
            $('div.permTabs').find('a').each(function () {
                $(this).attr('href', '#');
            });
            $('div.permTabs a').click(function () {
                var id = $(this).attr('id');
                $('.nav-profile').removeClass('selected');
                $(this).addClass('selected active');
                $(this).siblings().removeClass('active');
                $('.tab-profile').hide()
                $('.' + id).show();
            });
            $('.ajaxPower').change(function () {
                var tout = $(this).data('rel').split('||');
                var id_tab = tout[0];
                var id_profile = tout[1];
                var perm = tout[2];
                var enabled = $(this).is(':checked') ? 1 : 0;
                var tabsize = tout[3];
                var tabnumber = tout[4];
                var table = 'table#table_' + id_profile;
                if (perm == 'all' && $(this).parent().parent().hasClass('parent')) {
                    if (enabled) {
                        $(this).parent().parent().parent().find('.child-' + id_tab + ' input[type=checkbox]').prop('checked', false);
                        $(this).parent().parent().parent().find('.child-' + id_tab + ' input[type=checkbox]').prop('checked', true);
                    } else {
                        $(this).parent().parent().parent().find('.child-' + id_tab + ' input[type=checkbox]').prop('checked', false);
                    }
                    $.ajax({
                        url: $("#base_url").val() + "/permissions/save?controller=AdminAccess",
                        cache: false,
                        data: {
                            ajaxMode: '1',
                            id_tab: id_tab,
                            id_profile: id_profile,
                            perm: perm,
                            enabled: enabled,
                            submitAddAccess: '1',
                            addFromParent: '1',
                            action: 'updateAccess',
                            ajax: '1'
                        },
                        statusCode: customStatusCodeRes,
                        success: function (res, textStatus, jqXHR) {
                        }
                    });
                }
                perfect_access_js_gestion(this, perm, id_tab, tabsize, tabnumber, table);
                $.ajax({
                    url:  $("#base_url").val() + "/permissions/save?controller=AdminAccess",
                    cache: false,
                    data: {
                        ajaxMode: '1',
                        id_tab: id_tab,
                        id_profile: id_profile,
                        perm: perm,
                        enabled: enabled,
                        submitAddAccess: '1',
                        action: 'updateAccess',
                        ajax: '1'
                    },
                    statusCode: customStatusCodeRes,
                    success: function (res, textStatus, jqXHR) {
                    }
                });
            });

        });

        function perfect_access_js_gestion(src, action, id_tab, tabsize, tabnumber, table) {
            if (id_tab == '-1' && action == 'all') {
                $(table + ' .add').prop('checked', src.checked);
                $(table + ' .edit').prop('checked', src.checked);
                $(table + ' .delete').prop('checked', src.checked);
                $(table + ' .view').prop('checked', src.checked);
                $(table + ' .all').prop('checked', src.checked);
            }
            else if (action == 'all')
                $(table + ' .' + id_tab).prop('checked', src.checked);
            else if (id_tab == '-1')
                $(table + ' .' + action).prop('checked', src.checked);
            check_for_all_accesses(tabsize, tabnumber);
        }

        function check_for_all_accesses(tabsize, tabnumber) {
            var i = 0;
            var res = 0;
            var right = 0;
            var rights = new Array('view', 'add', 'edit', 'delete', 'all');

            while (i != parseInt(tabsize) + 1) {
                if ($('#view' + i).prop('checked') == false || $('#edit' + i).prop('checked') == false || $('#add' + i).prop('checked') == false || $('#delete' + i).prop('checked') == false)
                    $('#all' + i).prop('checked', false);
                else
                    $('#all' + i).prop('checked', true);
                i++;
            }
            right = 0;
            while (right != 5) {
                res = 0;
                i = 0;
                while (i != tabsize) {
                    if ($('#' + rights[right] + i).prop('checked') == true)
                        res++;
                    i++;
                }
                if (res == tabnumber - 1)
                    $('#' + rights[right] + 'all').prop('checked', true);
                else
                    $('#' + rights[right] + 'all').prop('checked', false);
                right++;
            }
        }
    </script>

    <script src="{{ asset('resources/assets/backjs/permission/jquery.chosen.js')}}"></script>


@endpush
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
                    <div class="col-md-12">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#tab1_0" data-toggle="tab">Super Admin</a></li>
                            <li><a href="#tab1_1" data-toggle="tab">Admin</a></li>
                            <li><a href="#tab1_2" data-toggle="tab">Inventory Manager</a></li>
                            <li><a href="#tab1_3" data-toggle="tab">Inventory Executive</a></li>
                            <li><a href="#tab1_4" data-toggle="tab">Delivery Boy</a></li>
<!--                            <li><a href="#tab1_5" data-toggle="tab">Customer(Site User)</a></li>
                            <li><a href="#tab1_6" data-toggle="tab">Guest (Site User)</a></li>-->
                            <li><a href="#tab1_7" data-toggle="tab">CRM Manager</a></li>
                            <li><a href="#tab1_8" data-toggle="tab">CRM Executive</a></li>
                            <li><a href="#tab1_9" data-toggle="tab">Accounting Manager</a></li>
                            <li><a href="#tab1_10" data-toggle="tab">Accounting Executive</a></li>
                            <li><a href="#tab1_11" data-toggle="tab">HR Manager</a></li>
                            <li><a href="#tab1_12" data-toggle="tab">HR Executive</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1_0">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Super Admin</h4></div>
                                        </div>
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        <input type="hidden" id="change_permission_url" value="{{url('/change-permission')}}">
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 1;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_1">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Admin</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 2;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_2">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Inventory Manager</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 3;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_3">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Inventory Executive</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 4;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_4">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Delivery Boy</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 5;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_5">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Customer(Site User)</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 7;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_6">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Guest (Site User)</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 8;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_7">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>CRM Manager</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 9;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_8">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>CRM Executive</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 10;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_9">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Accounting Manager</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 11;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_10">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Accounting Executive</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 12;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_11">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>HR Manager</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 13;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab1_12">
                                <div class="row example-row">
                                    <div class="col-md-12">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>HR Executive</h4></div>
                                        </div>
                                        <div class="overflow-table-edited">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>All</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $roleId = 14;
                                                $totCheck = 0;
                                                foreach ($permissionModuleList as $moduleList):
                                                    echo '<tr><td>' . $moduleList['module_name'] . '</td>';
                                                    $moduleId = $moduleList['id'];
                                                    $controller_id = $moduleList['controller_id'];
                                                    for ($actionId = 1; $actionId < 6; $actionId++) {
                                                        $funcTempIndex = $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        $function_id = '';
                                                        if (isset($permissionFunctionArray[$funcTempIndex])) {
                                                            $function_id = $permissionFunctionArray[$funcTempIndex];
                                                        }
                                                        $tempIndex = $roleId . '_' . $controller_id . '_' . $function_id;
                                                        $is_checked = '';
                                                        if (isset($permissionArray[$tempIndex]) || $totCheck >= 4) {
                                                            $is_checked = 'checked';
                                                            $totCheck++;
                                                        }
                                                        $checkboxValue = $roleId . '_' . $moduleId . '_' . $controller_id . '_' . $actionId;
                                                        echo '<td><div class="checkboxer">'
                                                        . '<input type="checkbox" onclick="changePermission(this)" id="' . $checkboxValue . '" value="' . $checkboxValue . '" ' . $is_checked . '>'
                                                        . '<label for="' . $checkboxValue . '"></label></div></td>';
                                                    }
                                                    echo '</tr>';
                                                endforeach;
                                                ?>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('resources/assets/backjs/permissionJs.js')}}"></script>


@stop
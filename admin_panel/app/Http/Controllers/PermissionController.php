<?php

namespace App\Http\Controllers;

use App\Models\PermissionAccessListModel;
use App\Models\PermissionFunctionListModel;
use App\Models\PermissionModel;
use App\Models\PermissionModuleListModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;

class PermissionController extends BaseController {

    public function index() {
        $data = array(
            'pagetitle' => 'Permission Management',
            'breadcamps' => array('List Permission' => 'list-permission'),
            'permissiondata' => PermissionModel::get(),
        );

        return view('permission/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        ////add functionality is here but prohibited////
//        $inputs = array(
//            'role_name' => Input::get('role_name'),
//            'description' => Input::get('description'),
//            'created_by' => Session::get('user_id'),
//        );
//
//        $rules = array(
//            'role_name' => "required|unique:roles",
//            'description' => "required",
//        );
//        $validate = Validator::make($inputs, $rules);
//        if ($validate->fails()) {
//            $errors = $validate->errors();
//            $errors = json_decode($errors);
//
//            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
//        } else {
//            $this->roleRepo->create($inputs);
//            Session::flash('success_message', 'New role has been created');
//            Session::flash('alert-class', 'alert-success');
//            return response()->json(['success' => TRUE,], 200);
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        $inputs = array(
            'module_name' => Input::get('module_name'),
            'description' => Input::get('description'),
        );

        $rules = array(
            'module_name' => "required|unique:permissions,module_name,$id",
//            'description' => "required",
        );
        $validate = Validator::make($inputs, $rules);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);

            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $this->permissionRepo->update($inputs, $id);

            Session::flash('success_message', 'Permission has been updated');
            Session::flash('alert-class', 'alert-success');
            return response()->json(['success' => TRUE,], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        ////delete functionality is here but prohibited////
//        $this->roleRepo->delete($id);
//        Session::flash('success_message', 'Role deleted');
//        Session::flash('alert-class', 'alert-success');
//        return redirect(env("STORE_BACK_PREFIX").'/list-role');
    }

    public function getpermission() {
        $id = Input::get('id');
        $permissiondata = $this->permissionRepo->find($id);
        echo $permissiondata;
    }

    public function managePermission() {
        $permissionAccessListData = PermissionAccessListModel::get();
        $permissionFunctionListData = PermissionFunctionListModel::get();
        $permissionArray = array();
        $permissionFunctionArray = array();
        foreach ($permissionAccessListData as $list):
            $tempIndex = $list['role_id'] . '_' . $list['controller_id'] . '_' . $list['function_id'];
            $permissionArray[$tempIndex] = 1;
        endforeach;
        foreach ($permissionFunctionListData as $func):
            $tempIndex = $func['module_id'] . '_' . $func['controller_id'] . '_' . $func['action_id'];
            $permissionFunctionArray[$tempIndex] = $func['id'];
        endforeach;
        
        //$permissionModuleList = PermissionModuleListModel::get();
        
        //var_dump($permissionModuleList);
        
//        echo '<pre>';
//        print_r($permissionFunctionArray);
//        die;
        $data = array(
            'pagetitle' => 'Permission Management',
            'breadcamps' => array('List Permission' => 'list-permission'),
            'permissiondata' => PermissionModel::get(),
            'permissionModuleList' => PermissionModuleListModel::get(),
            'permissionArray' => $permissionArray,
            'permissionFunctionArray' => $permissionFunctionArray,
        );

        return view('permission/permissionManageList', $data);
    }

    public function changePermission() {
        $action = Input::get('action');
        $allId = Input::get('allId');

        $idArray = explode('_', $allId);

        $role_id = $idArray[0];         //index 0 is role_id
        $module_id = $idArray[1];       //index 1 is module_id
        $controller_id = $idArray[2];   //index 2 is controller_id
        $action_id = $idArray[3];       //index 3 is action_id

        if ($action_id != 5) {

            $functionListData = PermissionFunctionListModel::where('controller_id', $controller_id)
                    ->where('action_id', $action_id)
                    ->where('module_id', $module_id)
                    ->get();

            $function_id = $functionListData[0]['id'];

            $accessListData = PermissionAccessListModel::where('role_id', $role_id)
                    ->where('controller_id', $controller_id)
                    ->where('function_id', $function_id)
                    ->get();

            if ($action == 1) { //if action is add permission
                if (count($accessListData) == 0) {     //if data does not exists already then only insert
                    $inputs = array(
                        'role_id' => $role_id,
                        'controller_id' => $controller_id,
                        'function_id' => $function_id,
                        'created_by' => Session::get('user_id'),
                    );
                    PermissionAccessListModel::insert($inputs);
                }
            } else {            //if action is remove permission
                if (count($accessListData) != 0) {       //delete only if data exists
                    PermissionAccessListModel::where('id', $accessListData[0]['id'])
                            ->delete();
                }
            }
        } else {
            for ($action_id_loop = 1; $action_id_loop < 5; $action_id_loop++) {
                
                $functionListData = PermissionFunctionListModel::where('controller_id', $controller_id)
                        ->where('action_id', $action_id_loop)
                        ->where('module_id', $module_id)
                        ->get();

                if(isset($functionListData[0]))
                $function_id = $functionListData[0]['id'];
                else
                $function_id = -1;

                $accessListData = PermissionAccessListModel::where('role_id', $role_id)
                        ->where('controller_id', $controller_id)
                        ->where('function_id', $function_id)
                        ->get();

                if ($action == 1) { //if action is add permission
                    if (count($accessListData) == 0) {     //if data does not exists already then only insert
                        $inputs = array(
                            'role_id' => $role_id,
                            'controller_id' => $controller_id,
                            'function_id' => $function_id,
                            'created_by' => Session::get('user_id'),
                        );
                        PermissionAccessListModel::insert($inputs);
                    }
                } else {            //if action is remove permission
                    if (count($accessListData) != 0) {       //delete only if data exists
                        PermissionAccessListModel::where('id', $accessListData[0]['id'])
                                ->delete();
                    }
                }
            }
        }
    }

}

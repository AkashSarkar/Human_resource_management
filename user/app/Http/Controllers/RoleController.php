<?php

namespace App\Http\Controllers;

use App\Models\ErrorR;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use View;

class RoleController extends BaseController
{

    public function index()
    {
        $data = array(
            'pagetitle' => 'Role Management',
            'breadcamps' => array('List Role' => 'list-role'),
            'roledata' => RoleModel::getRolesByPerm(),
        );

        return view('role.list', $data);
    }

    public function update($id)
    {
        $responseData = [];
        $responseData['success'] = TRUE;
        $responseData['title'] = "Roles";
        try {

            $inputs = array(
                'role_name' => Input::get('role_name'),
                'description' => Input::get('description'),
//                'updated_by' => Session::get('user_id'),
            );

            $rules = array(
                'role_name' => "required|unique:roles,role_name,$id",
                'description' => "required",
            );
            $validate = Validator::make($inputs, $rules);

            if ($validate->fails()) {
                $errors = $validate->errors();
                $errors = json_decode($errors);

                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                RoleModel::find($id)->update($inputs);
                $responseData['message'] = "Role has been updated";
                return respJOk($responseData);
            }
        } catch (\Exception $e) {
            ErrorR::efail($e);
            $responseData["success"] = False;
            $responseData["message"] = $e;
            return respJErroR($responseData, $e);
        }
    }

    public function getrole()
    {
        $id = Input::get('id');
        $roledata = RoleModel::find($id);
        return $roledata;
    }

}

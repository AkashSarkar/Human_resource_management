<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;

class RolePermissionController extends BaseController {

    public function index() {
        $data = array(
            'pagetitle' => 'Role Permission Management',
            'breadcamps' => array('List Role Permission' => 'list-rolePermission'),
            'allRolePermission' => $this->rolePermissionRepo->with('role', 'permission')->alldata(),
            'roles' => $this->roleRepo->all(),
            'permissions' => $this->permissionRepo->all(),
        );
        
//        echo '<pre>';
//        print_r($data['roles']);
//        die();

        return view('role_permission/list', $data);
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
        $inputs = array(
            'title' => Input::get('title'),
            'type' => Input::get('type'),
            'amount' => Input::get('amount'),
            'created_by' => Session::get('user_id'),
        );

        $rules = array(
            'title' => "required|unique:taxes",
            'type' => "required",
            'amount' => "required",
        );
        $validate = Validator::make($inputs, $rules);
        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);

            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $this->taxRepo->create($inputs);
            Session::flash('success_message', 'New tax method has been created');
            Session::flash('alert-class', 'alert-success');
            return response()->json(['success' => TRUE,], 200);
        }
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
            'title' => Input::get('title'),
            'type' => Input::get('type'),
            'amount' => Input::get('amount'),
            'updated_by' => Session::get('user_id'),
        );


        $rules = array(
            'title' => "required|unique:taxes,title,$id",
            'type' => "required",
            'amount' => "required",
        );
        $validate = Validator::make($inputs, $rules);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);

            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $this->taxRepo->update($inputs, $id);
            Session::flash('success_message', 'Tax method has been updated');
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
        $this->taxRepo->delete($id);
        Session::flash('success_message', 'Tax method deleted');
        Session::flash('alert-class', 'alert-success');
        return redirect(env("STORE_BACK_PREFIX").'/list-tax');
    }

    public function gettax() {
        $id = Input::get('id');
        $taxdata = $this->taxRepo->find($id);
        echo $taxdata;
    }

}

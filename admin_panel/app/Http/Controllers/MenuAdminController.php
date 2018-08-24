<?php

/**
 * Created by PhpStorm.
 * User: jihad
 * Date: 11/8/17
 * Time: 10:16 AM
 */

namespace App\Http\Controllers;

use App\Models\ErrorR;
use App\Models\MenuAdminModel;
use Dotenv\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MenuAdminController extends BaseController
{

    public function index()
    {
        $data = array(
            'pagetitle' => 'Menu Admin Management',
            'breadcamps' => array('List Menu Admin' => 'list-menu-admin'),
            'categories' => MenuAdminModel::get_nested(0),
            'imagepath' => $this->imagepath,
            'showimagepath' => $this->showimagepath,
        );
        $data['category_url_for_id'] = 0;
        return view('menu_admin/list', $data);
    }

    public function listcategory($id)
    {
        $data = array(
            'pagetitle' => 'Menu Admin Management',
            'breadcamps' => MenuAdminModel::get_cat_breadcamp($id),
            'categories' => MenuAdminModel::get_nested($id),
            'imagepath' => $this->imagepath,
            'showimagepath' => $this->showimagepath,
        );
        $data['breadcamps']['List Menu Admin'] = 'list-menu-admin';
        $data['breadcamps'] = array_reverse($data['breadcamps']);
        $data['category_url_for_id'] = $id;
        return view('menu_admin/list', $data);
    }

    public function store()
    {
        $inputs = array(
            'label' => Input::get('label'),
            'uri_name' => Input::get('uri_name'),
            'url' => Input::get('url'),
            'status' => 1,
            '_parent_id' => Input::get('parent'),
        );

        $rules = array(
            'label' => "required|max:128",
            'uri_name' => "required",
            'url' => "required",
        );
        $validate = Validator::make($inputs, $rules);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);
            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $inputs["_order_by"] = MenuAdminModel::where("_parent_id", $inputs["_parent_id"])->count();
            MenuAdminModel::create($inputs);
            return response()->json(['success' => TRUE], 200);
        }
    }

    public function update($id)
    {
        $catData = MenuAdminModel::find($id);

        $inputs = array(
            'title' => Input::get('title'),
            'uri_name' => Input::get('uri_name'),
            'url' => Input::get('url'),
        );

        if (Input::get('parent') == '') {
            $inputs['_parent_id'] = null;
        } else {
            $inputs['_parent_id'] = Input::get('parent');
        }


        $rules = array(
            'title' => "required|max:128",
            'uri_name' => "required",
            'url' => "required",
        );

        $validate = Validator::make($inputs, $rules);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);

            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {

            $catData->update($inputs);
            return response()->json(['success' => TRUE], 200);
        }
    }

    public function sortMenuAdmin()
    {
        $responseData = [];
        $responseData["title"] = "Menu Admin";
        $responseData["success"] = True;
        $responseData["message"] = "Sort updated";
        try {
            $cat_sort_data = Input::get('category');
            $catsortdata = $cat_sort_data;
            // prepare one query
            $q = "UPDATE " . with(new MenuAdminModel)->getTable() . " SET _sort = CASE id ";
            list($_q, $_qid) = get_sort_cat($catsortdata);
            $q .= $_q;
            $q .= "END WHERE id IN (";
            $q .= $_qid;
            $q = rtrim($q, ", ");
            $q .= ")";
            DB::update(DB::raw($q));
//            ActivityHistory::log('category', 'updated', 'mass_updated',
//                (int)Input::get('id_category_parent'), [],
//                '{causer} sorted category ' . MenuAdminModel::select("title")->find((int)Input::get('id_category_parent'))->title . " to " . ((Input::get('way') == 0) ? "up" : "down")
//            );//Activity-H
            return respJOk($responseData);

        } catch (\Exception $e) {
            $responseData["success"] = False;
            $responseData["message"] = "Sort updated error";
            ErrorR::efail($e);
        }
    }

    public function getCategoryAdd()
    {
        $responseData = [];
        $responseData["title"] = "Categories";
        $responseData["success"] = True;
        $responseData["message"] = "Fetch successful";
        try {
            return respJOk($this->get_cat_tree(Input::get('id')));
        } catch (\Exception $e) {
            $responseData["success"] = False;
            $responseData["message"] = "Fetch error";
            ErrorR::efail($e);
        }
    }

    protected function get_cat_tree($_parent_id)
    {
        return MenuAdminModel::get_nested_selected($_parent_id);
    }

    public function getcategory()
    {
        $responseData = [];
        $responseData["title"] = "Categories";
        $responseData["success"] = True;
        $responseData["message"] = "Fetch successful";
        try {
            $id = Input::get('id');
            $categorydata = MenuAdminModel::select(
                'id',
                'label',
                'uri_name',
                'url',
                '_parent_id'
            )->orderBy("_sort")
                ->find($id);
            $responseData['cat_tree'] = json_encode($this->get_cat_tree($categorydata->_parent_id));
            $responseData["data"] = $categorydata;
            return respJOk($responseData);
        } catch (\Exception $e) {
            $responseData["success"] = False;
            $responseData["message"] = "Fetch error";
            ErrorR::efail($e);
        }
    }
}
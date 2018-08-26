<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class MenuAdminModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    public $timestamps = TRUE;
    protected $fillable = array('label', 'uri_name', 'url', 'status', '_parent_id', '_sort');

    /**
     * THERE IS MANY LOGICAL REASON THAT THIS BELLOWING EVERY CODE EXIST
     **/
    static function get_nested($id = false)
    {

        $categories = MenuAdminModel::select('id', 'label', 'uri_name', 'url', 'status', '_parent_id', '_sort')
            ->orderBy("_sort")
            ->get();
        $subarray = array();
        $array = array();
        $catarray = array();
        foreach ($categories as $category) {
            if (!$category->_parent_id) {
// This page has no parent
                $array[$category->id]['id'] = $category->id;
                $array[$category->id]['label'] = $category->label;
                $array[$category->id]['uri_name'] = $category->uri_name;
                $array[$category->id]['url'] = $category->url;
                $array[$category->id]['status'] = $category->status;
                $array[$category->id]['_parent_id'] = $category->_parent_id;
                $array[$category->id]['_sort'] = $category->_sort;
                $catarray[$category->id] = $array[$category->id];
            } else {
// This is a child page
                $cat = [];
                $cat['id'] = $category->id;
                $cat['label'] = $category->label;
                $cat['uri_name'] = $category->uri_name;
                $cat['url'] = $category->url;
                $cat['status'] = $category->status;
                $cat['_parent_id'] = $category->_parent_id;
                $cat['_sort'] = $category->_sort;
                $catarray[$category->id] = $cat;
                $subarray[$category->_parent_id][] = $cat;
            }
        }
        if ($id) {
            return $array[$id]['children'] = MenuAdminModel::buildCategory($id, $subarray);
        }
        foreach ($array as $arr) {
            $array[$arr['id']]['children'] = MenuAdminModel::buildCategory($arr['id'], $subarray);
        }
        return $array;
    }


    protected static function buildCategory($parent, $category)
    {
        $array = [];
        if (isset($category[$parent])) {
            foreach ($category[$parent] as $cat) {
                $array[$cat['id']] = $cat;
                if (isset($category[$cat['_parent_id']])) {
                    $array[$cat['id']]["children"] = MenuAdminModel::buildCategory($cat['id'], $category);
                }
            }
        }
        return $array;
    }

    static function get_cat_breadcamp($id)
    {
        $categories = MenuAdminModel::select('id', 'label', 'uri_name', 'url', 'status', '_parent_id')
            ->orderBy("_sort")
            ->get();
        $catarray = array();
        foreach ($categories as $category) {
            if (!$category->_parent_id) {
// This page has no parent
                $catarray[$category->id]['id'] = $category->id;
                $catarray[$category->id]['label'] = $category->label;
                $catarray[$category->id]['status'] = $category->status;
                $catarray[$category->id]['_parent_id'] = $category->_parent_id;
            } else {
// This is a child page
                $cat = [];
                $cat['id'] = $category->id;
                $cat['label'] = $category->label;
                $cat['status'] = $category->status;
                $cat['_parent_id'] = $category->_parent_id;
                $catarray[$category->id] = $cat;
            }
        }


        return MenuAdminModel::get_nested_breadcamps($id, $catarray);

    }

    protected static function get_nested_breadcamps($parent, $category)
    {
        $array = [];
        if (isset($category[$parent])) {
            $array[$category[$parent]['label']] = 'list-menu-admin/' . $category[$parent]['id'];
            if (isset($category[$parent]['_parent_id']) && $category[$parent]['_parent_id']) {
                $array = array_merge($array, MenuAdminModel::get_nested_breadcamps($category[$parent]['_parent_id'], $category));
            }
        }
        return $array;
    }

    static function get_nested_selected($_parent_id)
    {
        $categories = MenuAdminModel::select('id', 'label', 'status', '_parent_id')
            ->orderBy("_sort")
            ->get();

        $subarray = [];
        $array = [];
        foreach ($categories as $category) {
            if (!$category->_parent_id) {
// This page has no parent
                $array[$category->id]['id'] = $category->id;
                $array[$category->id]['key'] = $category->id;
                $array[$category->id]['title'] = $category->label;
                $array[$category->id]['_parent_id'] = $category->_parent_id;
                if ($_parent_id == $category->id) {
                    $array[$category->id]['selected'] = true;
                    $array[$category->id]['expanded'] = true;
                }
                if ($category->status == 'Inactive') {
                    $array[$category->id]['unselectable'] = true;
                }
            } else {
// This is a child page
                $cat = [];
                $cat['id'] = $category->id;
                $cat['key'] = $category->id;
                $cat['title'] = $category->label;
                $cat['_parent_id'] = $category->_parent_id;
                if ($_parent_id == $category->id) {
                    $cat['selected'] = true;
                    $cat['expanded'] = true;
                }
                if ($category->status == 'Inactive') {
                    $cat['unselectable'] = true;
                }
                $subarray[$category->_parent_id][] = $cat;
            }
        }
        $arrayResp = [];
        $no_parent['id'] = 0;
        $no_parent['title'] = "No Parent";
        $no_parent['_parent_id'] = 0;
        if ($_parent_id == 0) {
            $no_parent['selected'] = true;
        }
        array_push($arrayResp, $no_parent);
        foreach ($array as $arr) {
            list($array[$arr['id']]['children'], $expanded) = MenuAdminModel::buildCategoryArray($arr['id'], $subarray);
            if ($expanded) {
                $array[$arr['id']]['expanded'] = True;
            }
            array_push($arrayResp, $array[$arr['id']]);
        }
        return $arrayResp;
    }

    protected static function buildCategoryArray($parent, $category)
    {
        $array = [];
        $expand = False;
        if (isset($category[$parent])) {
            foreach ($category[$parent] as $cat) {
                if (isset($category[$cat['_parent_id']])) {
                    list($cat["children"], $expanded) = MenuAdminModel::buildCategoryArray($cat['id'], $category);
                    if ($expanded) {
                        $expand = True;
                        $cat['expanded'] = True;
                    }
                }
                if (isset($cat['selected']) && $cat['selected']) {
                    $expand = True;
                }
                array_push($array, $cat);
            }
        }
        return [$array, $expand];
    }

}

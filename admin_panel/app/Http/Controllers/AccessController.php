<?php

namespace App\Http\Controllers;

use App\Models\AccessModel;
use App\Models\ErrorR;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AccessController extends BaseController
{

    public function index()
    {
        try {
            $data = array(
                'pagetitle' => 'Permission Management',
                'breadcamps' => array('List Permission' => 'list-permission'),
            );
            $data['total_perm'] = AccessModel::get_perm_count();
            $data['perms_data'] = AccessModel::get_perm();
            $data['roles'] = DB::table('roles')->whereNotIn("id", [7, 8])->get();
            return view('access.list', $data);
        } catch (\Exception $e) {
            ErrorR::efail($e);
        }
    }

    public function updatePerm()
    {
        try {
            $responseData = [];
            $responseData["title"] = "Permissions";
            $responseData["success"] = True;
            $responseData["message"] = "Update successful";

            $ajaxMode = Input::get('ajaxMode');
            $id_tab = Input::get('id_tab');
            $id_profile = Input::get('id_profile');
            $perm = Input::get('perm');
            $enabled = Input::get('enabled');
            $submitAddAccess = Input::get('submitAddAccess');
            $action = Input::get('action');
            $ajax = Input::get('ajax');

            $where = "";
            if ($perm == "all") {
                if ($id_tab == -1) {
                    AccessModel::where("perm_role_id", $id_profile)->update([
                        "perm_view" => $enabled,
                        "perm_add" => $enabled,
                        "perm_edit" => $enabled,
                        "perm_delete" => $enabled,
                        "perm_all" => $enabled,
                    ]);
                    return respJOk($responseData);

                }
                $data['perm_view'] = $enabled;
                $data['perm_add'] = $enabled;
                $data['perm_edit'] = $enabled;
                $data['perm_delete'] = $enabled;
            } elseif ($id_tab == -1) {
                AccessModel::where("perm_role_id", $id_profile)->update(["perm_$perm" => $enabled]);
                return respJOk($responseData);
            }
            $data['perm_' . $perm] = $enabled;
            AccessModel::find($id_tab)->update($data);
            return respJOk($responseData);
        } catch (\Exception $e) {
            ErrorR::efail($e);
            $responseData["success"] = False;
            $responseData["message"] = "Update error";
            return respJErroR($responseData, $e);
        }

    }

    public function sync($id)
    {
        try {
            $responseData = [];
            $responseData["title"] = "Permissions";
            $responseData["success"] = True;
            $responseData["message"] = "Sync successful";
            AccessModel::perm_extra_clear($id);
            $perm_missed_page = AccessModel::perm_missed_page($id);
            $permissions = [];

            foreach ($perm_missed_page as $perm_missed_page) {
                $permission['perm_module_id'] = $perm_missed_page->id;
                $permission['perm_role_id'] = $id;
                $permissions[] = $permission;
            }

            AccessModel::insert($permissions);
            return respJOk($responseData);

        } catch (\Exception $e) {
            ErrorR::efail($e);
            $responseData["success"] = False;
            $responseData["message"] = "Sync error";
            return respJErroR($responseData, $e);
        }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccessModel extends Model
{
    protected $fillable = array(
        'perm_role_id',
        'perm_module_id',
        'perm_view',
        'perm_add',
        'perm_edit',
        'perm_delete',
        'perm_all'
    );
    protected $table = 'access';
    protected $primaryKey = 'id';
    public $timestamps = TRUE;

    static function get_perm_count()
    {
        return DB::table("access")->count();
    }


    public static function get_perm()
    {
        $access = DB::table("access")->select(
            'id',
            'perm_role_id',
            'perm_module_id',
            'perm_view',
            'perm_add',
            'perm_edit',
            'perm_delete',
            'perm_all',
            DB::raw('(SELECT name FROM modules WHERE id=perm_module_id) as module_name')
        )
            ->orderBy("perm_module_id")
            ->get();
        $perms = array();
        foreach ($access as $data) {
            $perms[$data->perm_role_id][] = $data;
        }
        return $perms;
    }

    static function perm_missed_page($id)
    {
        try {
            $modules = DB::table('modules')
                ->select('access.id', 'modules.id')
                ->leftJoin('access', function ($join) use ($id) {
                    $join->on('modules.id', '=', 'access.perm_module_id')
                        ->where('access.perm_role_id', '=', $id);
                })
                ->whereNull('access.id')
                ->orderBy('modules.id', "ASC");
            return $modules->get();
        } catch (\Exception $e) {
            ErrorR::efail($e);
        }
    }

    static function perm_extra_clear($id)
    {
        try {
            $perm = DB::table('access')
                ->select("id")
                ->where("perm_role_id", $id)
                ->whereNotIn("perm_module_id", function ($query) {
                    $query->from('modules')->select("id");
                });
            $perm->delete();

            $permDup = DB::table('access as n1')
                ->select("n1.id")
                ->join('access as n2', 'n1.id', '<', 'n2.id')
                ->where("n1.perm_role_id", $id)
                ->where('n1.perm_role_id', '=', DB::raw('n2.perm_role_id'))
                ->where('n1.perm_module_id', '=', DB::raw('n2.perm_module_id'))
                ->lists('id');
            DB::table('access')->whereIn("id", $permDup)->delete();
            return true;
        } catch (\Exception $e) {
            ErrorR::efail($e);
        }
    }

    static function perm_route()
    {
        $accessArray = [];

        if (Auth::check()) {
            $accessData = DB::table("access")->select(
                'id',
                'perm_role_id',
                'perm_module_id',
                'perm_view',
                'perm_add',
                'perm_edit',
                'perm_delete',
                'perm_all',
                DB::raw('(SELECT tag FROM modules WHERE id=perm_module_id) as module_tag')
            )
                ->where("perm_role_id", Auth::user()->role_id)
                ->orderBy("perm_module_id")
                ->get();
            foreach ($accessData as $data) {
                $accessArray[$data->module_tag]["view"] = $data->perm_view;
                $accessArray[$data->module_tag]["add"] = $data->perm_add;
                $accessArray[$data->module_tag]["edit"] = $data->perm_edit;
                $accessArray[$data->module_tag]["delete"] = $data->perm_delete;
                $accessArray[$data->module_tag]["all"] = $data->perm_all;
            }
        }
//        prd($accessArray);
        return $accessArray;
    }
}

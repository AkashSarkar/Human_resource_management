<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class RoleModel extends Model
{

    protected $fillable = array('role_name', 'description', 'created_by', 'updated_by');
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = TRUE;

    public function getAdminAddRoles()
    {
        $data = RoleModel::whereNotIn('id', [1, 7, 8])
            ->get();
        return $data;
    }

    public function getRoles($roleId)
    {
        $data = RoleModel::whereIn('id', $roleId)
            ->get();
        return $data;
    }

    public function getdeloveryRoles($id)
    {
        $data = RoleModel::where('id', $id)
            ->get();
        return $data;
    }

    public static function getRolesByPerm()
    {
        $rolesPerms = DB::select("SELECT roles.id,roles.role_name,roles.description,group_concat(CASE WHEN access.id is NULL THEN modules.id END order by modules.id) as module_ids,SUM(CASE WHEN access.id is NULL THEN 1 ELSE 0 END) as need_access,extra_access FROM roles join modules left join access  on access.perm_role_id= roles.id and access.perm_module_id=modules.id left join (SELECT count(`access`.id) as extra_access,`access`.perm_role_id FROM `access` INNER JOIN( SELECT `access`.id FROM `access` GROUP BY perm_role_id,perm_module_id HAVING COUNT(id) >1  
)temp ON access.id= temp.id GROUP BY perm_role_id) as extra_access on roles.id=extra_access.perm_role_id WHERE roles.id not in (7,8) GROUP BY roles.id");
        return $rolesPerms;
    }

} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RolePermissionModel extends Model {

    public $table = 'role_permissions';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array('role_id', 'permission_id');
    
    public function role() {
        return $this->hasOne("App\Models\RoleModel", "id", "role_id");
    }
    
    public function permission() {
        return $this->hasOne("App\Models\PermissionModel", "id", "permission_id");
    }

}

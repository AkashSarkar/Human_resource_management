<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionAccessListModel extends Model {

    public $table = 'permission_access_list';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array('role_id', 'controller_id', 'function_id', 'created_by', 'updated_by');

}

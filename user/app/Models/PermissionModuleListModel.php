<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PermissionModuleListModel extends Model {

    public $table = 'permission_module_list';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array('controller_id', 'module_name');

}

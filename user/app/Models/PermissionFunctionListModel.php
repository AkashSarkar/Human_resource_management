<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PermissionFunctionListModel extends Model {
    public $table = 'permission_function_list';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array('controller_id', 'action_id', 'module_id', 'function_name');

}

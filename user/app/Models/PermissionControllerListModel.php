<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionControllerListModel extends Model {
    public $table = 'permission_controller_list';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array('controller_name');

}

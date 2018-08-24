<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionActionListModel extends Model {

    public $table = 'permission_action_list';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array();

}

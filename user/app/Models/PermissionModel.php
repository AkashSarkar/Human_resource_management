<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PermissionModel extends Model {

    public $table = 'permissions';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = array('route_url', 'module_name', 'description');

}

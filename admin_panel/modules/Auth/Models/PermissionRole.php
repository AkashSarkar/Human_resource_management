<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 12:51 PM
 */

namespace Modules\Auth\Models;
use Illuminate\Database\Eloquent\Model;

class PermissionRole
{
    protected $fillable = [
        'admin_permission_id','admin_role_id'
    ];
}
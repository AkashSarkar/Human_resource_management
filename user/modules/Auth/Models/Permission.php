<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 12:05 PM
 */

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'permission'
    ];
    public function adminRoles()
    {
        return $this->belongsToMany(Role::class);
    }
}
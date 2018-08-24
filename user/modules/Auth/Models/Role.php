<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 12:01 PM
 */
namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    protected $fillable = [
        'role'
    ];

    public function adminPermissions()
    {
        return $this->belongsToMany(Permission::class);
    }


}
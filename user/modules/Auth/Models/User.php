<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = [
        'name','email','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function adminRoles()
    {
        return $this->belongsToMany(Role::class);
    }
}

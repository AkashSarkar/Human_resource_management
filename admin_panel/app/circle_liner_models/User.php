<?php

namespace App\cirle_liner_models;



use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'pgsql_front';
    protected $fillable = [
        'hash_id','first_name', 'last_name', 'gender', 'dob', 'status', 'role_id', 'created_at', 'updated_at',

    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function posts()
    {
        return $this->hasMany('App\cirle_liner_models\Post');
    }
}

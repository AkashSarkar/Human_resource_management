<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\User\Models;
use Illuminate\Database\Eloquent\Model;
class EmployeeModel extends Model
{

    protected $connection = 'pgsql_user';
    protected $table='users';
    protected $fillable = [
        'name','email','password','f_name','phone','dob','p_address','l_address','remember_token','created_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];
}
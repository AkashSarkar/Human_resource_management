<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/24/18
 * Time: 12:43 PM
 */
namespace Modules\User\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $connection = 'pgsql_front';
    protected $fillable = [
        'hash_id','first_name', 'last_name', 'gender', 'dob', 'status', 'role_id', 'created_at', 'updated_at',

    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\User\Models;
use Illuminate\Database\Eloquent\Model;
class PositionModel extends Model
{

    protected $connection = 'pgsql_user';
    protected $table='companies';
    protected $fillable = [
        'department_id','designation','doj','doe','status','salary','user_id','created_at',
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
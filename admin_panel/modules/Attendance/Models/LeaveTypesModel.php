<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Attendance\Models;
use Illuminate\Database\Eloquent\Model;
class LeaveTypesModel extends Model
{
    protected $connection = 'pgsql_user';
    protected $table='leave_types';
    protected $fillable = [
        'id','name','created_at',
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
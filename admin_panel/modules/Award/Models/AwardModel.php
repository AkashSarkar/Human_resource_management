<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Award\Models;
use Illuminate\Database\Eloquent\Model;
class AwardModel extends Model
{
    protected $connection="pgsql_user";
    protected $table='awards';
    protected $fillable = [
        'user_id','award','month','gift','created_at',
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
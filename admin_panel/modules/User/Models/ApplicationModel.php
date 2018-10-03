<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\User\Models;
use Illuminate\Database\Eloquent\Model;
class ApplicationModel extends Model
{

    protected $connection = 'pgsql_user';
    protected $table='leaves';
    protected $fillable = [
      'l_type_id','user_id','date','reason','status','created_at'
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
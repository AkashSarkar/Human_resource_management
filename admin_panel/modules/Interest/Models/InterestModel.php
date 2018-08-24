<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Interest\Models;
use Illuminate\Database\Eloquent\Model;
class InterestModel extends Model
{
    protected $connection = 'pgsql';
    protected $table='interests';
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
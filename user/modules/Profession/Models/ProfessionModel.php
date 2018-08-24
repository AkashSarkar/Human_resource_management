<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Profession\Models;
use Illuminate\Database\Eloquent\Model;
class ProfessionModel extends Model
{
    protected $connection = 'pgsql';
    protected $table='professions';
    protected $fillable = [
        'name',
        'connection_type_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
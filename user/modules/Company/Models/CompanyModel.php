<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Company\Models;
use Illuminate\Database\Eloquent\Model;
class CompanyModel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'pgsql';
    protected $table='companies';
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
<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\User\Models;
use Illuminate\Database\Eloquent\Model;
class AccountModel extends Model
{

    protected $connection = 'pgsql_user';
    protected $table='bank_acs';
    protected $fillable = [
        'ac_name','ac_number','bank','ifsc','pan','branch','user_id','created_at',
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
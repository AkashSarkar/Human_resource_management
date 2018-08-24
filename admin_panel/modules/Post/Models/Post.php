<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:23 PM
 */
namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */
    protected $connection = 'pgsql_front';
    protected $fillable = [
        'post_data','post_type_id','user_id','hash_id','created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id','updated_at'
    ];

}
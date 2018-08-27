<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Notice\Models;
use Illuminate\Database\Eloquent\Model;
class NoticeModel extends Model
{
    protected $table='notice';
    protected $fillable = [
        'title','description','created_at',
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
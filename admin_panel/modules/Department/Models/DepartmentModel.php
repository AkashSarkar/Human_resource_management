<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/24/18
 * Time: 12:43 PM
 */
namespace Modules\Department\Models;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    protected $table='department';
    protected $fillable = [
          'department','designation','created_at'
    ];
}
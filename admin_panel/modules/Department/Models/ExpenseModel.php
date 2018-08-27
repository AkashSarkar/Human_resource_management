<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Expense\Models;
use Illuminate\Database\Eloquent\Model;
class ExpenseModel extends Model
{
    protected $table='expense';
    protected $fillable = [
        'item','purchase_from','purchase_date','price','created_at',
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
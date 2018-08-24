<?php

namespace App\Models\Boot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

/* Fix: Incompatibility error for using same property both at trait and class in php version < 7 */
error_reporting(E_ALL ^ E_STRICT);

class BModel extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $shop_id;
    protected $_allowShop = false;

    public function __construct(array $attributes = [])
    {

        if ($this->_allowShop) {
            $this->shop_id = Session::get("shop_id");
        }
        parent::__construct($attributes);
    }


    public function newQuery()
    {
        $this->shop_id = Session::get("shop_id");
        $query = parent::newQuery();
        if ($this->_allowShop) {
            if ($this->shop_id) {
                $query->where($this->table . ".shop_id", '=', $this->shop_id);
            }
        }
        return $query;
    }
}
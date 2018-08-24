<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/23/18
 * Time: 5:22 PM
 */

namespace Modules\Profession\Models\DataModel;


class Profession
{
    public $id;
    public $profession;
//    public $cTypeId;
//    public $createdOn;
//    public $updatedOn;


    function __construct()
    {

        $this->id = 0;
        $this->profession = '';
//        $this->cTypeId = '';
//        $this->createdOn = '';
//        $this->updatedOn = '';
    }

    public function castMe($obj)
    {
        if ($obj != null) {
            $this->id = $obj->id;
            $this->profession = $obj->name;
//            $this->cTypeId = $obj->connection_type_id;
//            $this->createdOn = $obj->created_at;
//            $this->updatedOn = $obj->updated_at;

        }
    }
}
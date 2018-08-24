<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:17 PM
 */

namespace Modules\Company\Models\DataModel;

class Company
{
    public $id;
    public $company;
//    public $cTypeId;
//    public $createdOn;
//    public $updatedOn;


    function __construct()
    {

        $this->id = 0;
        $this->company = '';
//        $this->cTypeId = '';
//        $this->createdOn = '';
//        $this->updatedOn = '';
    }

    public function castMe($obj)
    {
        if ($obj != null) {
            $this->id = $obj->id;
            $this->company = $obj->name;
//            $this->cTypeId = $obj->connection_type_id;
//            $this->createdOn = $obj->created_at;
//            $this->updatedOn = $obj->updated_at;

        }
    }

}
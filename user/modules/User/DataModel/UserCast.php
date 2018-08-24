<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/28/18
 * Time: 6:06 PM
 */

namespace Modules\User\DataModel;

//use Illuminate\Database\Eloquent\Model;
use Modules\User\DataModel\BaseDataModel;


class UserCast
{
    public $id;
    public $hid;
    public $fName;
    public $lName;
    public $gender;
    public $dob;
    public $status;
    public $role;


    function __construct()
    {

        $this->id = 0;
        $this->hid = '';
        $this->fName = '';
        $this->lName = '';
        $this->gender = '';
        $this->dob = '';
        $this->status = '';
        $this->role = '';
    }

    public function castMe($obj)
    {
        if ($obj != null) {
            $this->id = $obj->id;
            $this->hid = $obj->hash_id;
            $this->fName = $obj->first_name;
            $this->lName = $obj->last_name;
            $this->gender = $obj->gender;
            $this->dob = $obj->dob;
            $this->status = $obj->status;
            $this->role = $obj->role_id;
        }
    }
}
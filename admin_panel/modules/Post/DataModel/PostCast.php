<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 11:51 AM
 */

namespace Modules\Post\DataModel;


class PostCast
{
    public $id;
    public $hid;
    public $pData;
    public $pType;
    public $uId;
    public $comment;
    public $share;
    public $createdOn;
    public $updatedOn;


    function __construct()
    {

        $this-> id=0;
        $this-> hid='';
        $this-> pData='';
        $this-> pType='';
        $this-> uId='';
        $this-> comment=0;
        $this-> share=0;
        $this-> createdOn='';
        $this-> updatedOn='';
    }
    public function castMe($obj)
    {
        if ($obj != null) {
            $this-> id=$obj->id;
            $this-> hid=$obj->hash_id;
            $this-> pData=$obj->post_data;
            $this-> pType=$obj->post_type_id;
            $this-> uId=$obj->user_id;
            $this-> comment=$obj->is_commentable;
            $this-> share=$obj->is_shareable;
            $this-> createdOn=$obj->created_at->format('d-m-y'.' '.'h:m:s');
            $this-> updatedOn=$obj->updated_at->format('d-m-y'.' '.'h:m:s');

        }
    }

}
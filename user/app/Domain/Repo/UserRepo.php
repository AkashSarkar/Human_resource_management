<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 1:58 PM
 */
namespace App\Domain\Repo;

interface UserRepo
{
    function allUser();
    function save($params);
    function update($obj);
    function delete($params);
    function generateHashId();
    function getOneUser($id);

}
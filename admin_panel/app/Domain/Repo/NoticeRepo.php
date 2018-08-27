<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:55
 */

namespace App\Domain\Repo;


interface NoticeRepo
{
    function filterDT();
    function totalCountDT();
    function filterSingleDT();

    function create($obj);
    function destroy($obj);
    function update($obj);
}
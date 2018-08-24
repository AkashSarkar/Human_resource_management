<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:09 PM
 */

namespace App\Domain\Repo;


interface IndustryRepo
{
    function filterDT();
    function totalCountDT();
    function filterSingleDT();

    function create($obj);
    function destroy($obj);
    function update($obj);
    function show($obj);
}
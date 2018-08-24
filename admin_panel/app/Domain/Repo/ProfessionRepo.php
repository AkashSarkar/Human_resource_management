<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/24/18
 * Time: 9:57 AM
 */
namespace App\Domain\Repo;


interface ProfessionRepo
{
    function filterDT();
    function totalCountDT();
    function filterSingleDT();

    function create($obj);
    function destroy($obj);
    function update($obj);
    function show($obj);
}
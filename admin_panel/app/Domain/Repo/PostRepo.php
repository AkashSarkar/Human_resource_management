<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 1:58 PM
 */
namespace App\Domain\Repo;

interface PostRepo
{
    function allPost();
    function totalPosts();
    function totalStatus();
    function totalEvents();
    function totalAwards();
    function totalPromotions();
    function totalArticles();
    function totalConferences();
    function totalProjects();
    function update($params);

}
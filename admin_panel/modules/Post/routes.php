<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Post', 'namespace' => 'Modules\Post\Controllers','middleware' => 'web'], function () {


    Route::get('/post', 'PostController@index')->name('post');
    Route::get('/post-data', 'PostController@getPosts');
    Route::get('/total-post', 'PostController@totalPosts')->name('total-post');


});
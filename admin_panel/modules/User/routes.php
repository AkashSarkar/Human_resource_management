<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'User', 'namespace' => 'Modules\User\Controllers', 'middleware' => 'web'], function () {
    Route::get('user', 'UserController@index')->name('user');
    Route::get('list-user-datatable', 'UserController@getUserData')->name('list-user-datatable');
    Route::get('user-details', 'UserController@getUser')->name('user-details');
    Route::post('create-user', 'UserController@store')->name('create-user');
    Route::patch('edit-user', 'UserController@edit')->name('edit-user');
    Route::delete('delete-user', 'UserController@delete')->name('delete-user');
    Route::get('role-user', 'UserController@getRole')->name('role-user');
});
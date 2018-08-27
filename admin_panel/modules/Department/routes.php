<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Department', 'namespace' => 'Modules\Department\Controllers', 'middleware' => 'web'], function () {


    Route::get('department', 'DepartmentController@index')->name('department');
    Route::post('department', 'DepartmentController@store')->name('department');
    Route::get('department/{id}', 'DepartmentController@show');
    Route::patch('department/{id}', 'DepartmentController@update');
    Route::delete('department/{id}', 'DepartmentController@destroy');


    Route::post('list-department-datatable', 'DepartmentController@jsonDataTable')->name('list-department-datatable');


});
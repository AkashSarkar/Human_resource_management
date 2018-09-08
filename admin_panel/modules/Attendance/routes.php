<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */

Route::group(['Module' => 'Attendance', 'namespace' => 'Modules\Attendance\Controllers', 'middleware' => 'web'], function () {

    //Leave module
    $module='Leave';
    $module_prefix=strtolower($module);
    Route::get($module_prefix, $module.'TypesController@index')->name($module_prefix);
    Route::post($module_prefix, $module.'TypesController@store')->name($module_prefix);
//    Route::get($module_prefix.'/{id}', $module.'Controller@show');
    Route::patch($module_prefix.'/{id}', $module.'TypesController@update');
    Route::delete($module_prefix.'/{id}', $module.'TypesController@destroy');

    Route::post('list-'.$module_prefix.'-datatable', $module.'TypesController@jsonDataTable')->name('list-'.$module_prefix.'-datatable');




});
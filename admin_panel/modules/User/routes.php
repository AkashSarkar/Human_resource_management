<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */

Route::group(['Module' => 'User', 'namespace' => 'Modules\User\Controllers', 'middleware' => 'web'], function () {

    //Employee module
    $module='Employee';
    $module_prefix=strtolower($module);
    Route::get($module_prefix, $module.'Controller@index')->name($module_prefix);
    Route::post($module_prefix, $module.'Controller@store')->name($module_prefix);
//    Route::get($module_prefix.'/{id}', $module.'Controller@show');
    Route::patch($module_prefix.'/{id}', $module.'Controller@update');
    Route::delete($module_prefix.'/{id}', $module.'Controller@destroy');

    Route::get($module_prefix.'/uid', $module.'Controller@uid');


    Route::post('list-'.$module_prefix.'-datatable', $module.'Controller@jsonDataTable')->name('list-'.$module_prefix.'-datatable');

    //Account Module
    $module='Account';
    $module_prefix=strtolower($module);
    Route::get($module_prefix, $module.'Controller@index')->name($module_prefix);
    Route::post($module_prefix, $module.'Controller@store')->name($module_prefix);
//    Route::get($module_prefix.'/{id}', $module.'Controller@show');
    Route::patch($module_prefix.'/{id}', $module.'Controller@update');
    Route::delete($module_prefix.'/{id}', $module.'Controller@destroy');

    Route::get($module_prefix.'/details', $module.'Controller@details');


    Route::post('list-'.$module_prefix.'-datatable', $module.'Controller@jsonDataTable')->name('list-'.$module_prefix.'-datatable');

    //Position Module
    $module='Position';
    $module_prefix=strtolower($module);
    Route::get($module_prefix, $module.'Controller@index')->name($module_prefix);
    Route::post($module_prefix, $module.'Controller@store')->name($module_prefix);
    Route::get($module_prefix.'/{id}', $module.'Controller@show');
    Route::patch($module_prefix.'/{id}', $module.'Controller@update');
    Route::delete($module_prefix.'/{id}', $module.'Controller@destroy');


    Route::post('list-'.$module_prefix.'-datatable', $module.'Controller@jsonDataTable')->name('list-'.$module_prefix.'-datatable');



    //Application Module
    $module='Application';
    $module_prefix=strtolower($module);
    Route::get($module_prefix, $module.'Controller@index')->name($module_prefix);
    Route::post($module_prefix, $module.'Controller@store')->name($module_prefix);
    Route::get($module_prefix.'/{id}', $module.'Controller@show');
    Route::patch($module_prefix.'/{id}', $module.'Controller@update');
    Route::delete($module_prefix.'/{id}', $module.'Controller@destroy');


    Route::post('list-'.$module_prefix.'-datatable', $module.'Controller@jsonDataTable')->name('list-'.$module_prefix.'-datatable');





});
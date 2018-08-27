<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Notice', 'namespace' => 'Modules\Notice\Controllers', 'middleware' => 'web'], function () {


    Route::get('notice', 'NoticeController@index')->name('notice');
    Route::post('notice', 'NoticeController@store')->name('notice');
    Route::get('notice/{id}', 'NoticeController@show');
    Route::patch('notice/{id}', 'NoticeController@update');
    Route::delete('notice/{id}', 'NoticeController@destroy');


    Route::post('list-notice-datatable', 'NoticeController@jsonDataTable')->name('list-notice-datatable');


});
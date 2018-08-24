<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Industry', 'namespace' => 'Modules\Industry\Controllers', 'middleware' => 'web'], function () {


    Route::get('industry', 'IndustryController@index')->name('industry');
    Route::post('industry', 'IndustryController@store')->name('industry');
    Route::get('industry/{id}', 'IndustryController@show');
    Route::patch('industry/{id}', 'IndustryController@update');
    Route::delete('industry/{id}', 'IndustryController@destroy');


    Route::post('list-industry-datatable', 'IndustryController@jsonDataTable')->name('list-industry-datatable');


});
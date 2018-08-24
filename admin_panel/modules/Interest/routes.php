<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Interest', 'namespace' => 'Modules\Interest\Controllers', 'middleware' => 'web'], function () {


    Route::get('interest', 'InterestController@index')->name('interest');
    Route::post('interest', 'InterestController@store')->name('interest');
    Route::get('interest/{id}', 'InterestController@show');
    Route::patch('interest/{id}', 'InterestController@update');
    Route::delete('interest/{id}', 'InterestController@destroy');


    Route::post('list-interest-datatable', 'InterestController@jsonDataTable')->name('list-interest-datatable');


});
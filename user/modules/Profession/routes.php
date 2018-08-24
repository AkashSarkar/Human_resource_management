<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Profession', 'namespace' => 'Modules\Profession\Controllers', 'middleware' => 'web'], function () {


    Route::get('profession', 'ProfessionController@index')->name('profession');
    Route::post('profession', 'ProfessionController@store')->name('profession');
    Route::get('profession/{id}', 'ProfessionController@show');
    Route::patch('profession/{id}', 'ProfessionController@update');
    Route::delete('profession/{id}', 'ProfessionController@destroy');


    Route::post('list-profession-datatable', 'ProfessionController@jsonDataTable')->name('list-profession-datatable');


});
<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Education', 'namespace' => 'Modules\Education\Controllers', 'middleware' => 'web'], function () {


    Route::get('education', 'EducationController@index')->name('education');
    Route::post('education', 'EducationController@store')->name('education');
    Route::get('education/{id}', 'EducationController@show');
    Route::patch('education/{id}', 'EducationController@update');
    Route::delete('education/{id}', 'EducationController@destroy');


    Route::post('list-education-datatable', 'EducationController@jsonDataTable')->name('list-education-datatable');


});
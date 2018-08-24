<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Company', 'namespace' => 'Modules\Company\Controllers', 'middleware' => 'web'], function () {


    Route::get('company', 'CompanyController@index')->name('company');
    Route::post('company', 'CompanyController@store')->name('company');
    Route::get('company/{id}', 'CompanyController@show');
    Route::patch('company/{id}', 'CompanyController@update');
    Route::delete('company/{id}', 'CompanyController@destroy');


    Route::post('list-Company-datatable', 'CompanyController@jsonDataTable')->name('list-company-datatable');


});
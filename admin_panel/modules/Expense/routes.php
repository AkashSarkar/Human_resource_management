<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:22 PM
 */
Route::group(['Module' => 'Expense', 'namespace' => 'Modules\Expense\Controllers', 'middleware' => 'web'], function () {


    Route::get('expense', 'ExpenseController@index')->name('expense');
    Route::post('expense', 'ExpenseController@store')->name('expense');
    Route::get('expense/{id}', 'ExpenseController@show');
    Route::patch('expense/{id}', 'ExpenseController@update');
    Route::delete('expense/{id}', 'ExpenseController@destroy');


    Route::post('list-expense-datatable', 'ExpenseController@jsonDataTable')->name('list-expense-datatable');


});
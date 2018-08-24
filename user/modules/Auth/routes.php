<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/20/18
 * Time: 2:52 PM
 */
Route::get('/', function () {
    return view('welcome');
});



Route::group(['Module' => 'Auth', 'namespace' => 'Modules\Auth\Controllers','middleware' => 'web'], function () {

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', function () {
        return view('Auth::login');
    });

});
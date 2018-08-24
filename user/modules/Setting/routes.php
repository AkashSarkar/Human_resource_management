<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/12/18
 * Time: 1:09 PM
 */
Route::group(['Module' => 'Setting', 'namespace' => 'Modules\Setting\Controllers', 'middleware' => 'web'], function () {
    Route::get('setting', 'SettingController@index')->name('setting');
    Route::patch('edit-setting', 'SettingController@update')->name('edit-setting');

});
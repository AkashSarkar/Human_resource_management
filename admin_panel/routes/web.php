<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



//ErrorR Log
Route::get('errorr', "ErrorRController@index")->name('errorr');
Route::post('errorr/datatable', "ErrorRController@dataTable")->name('errorr/datatable');
Route::get('errorr/delete', "ErrorRController@destroy")->name('errorr/delete');
Route::get('performance', "PerformanceController@index")->name('performance');
Route::post('performance/datatable', "PerformanceController@dataTable");
Route::get('performance/delete', "PerformanceController@destroy")->name('performance/delete');
//Activity History
Route::get('activity-history', "ActivityHistoryController@index")->name('activity-history');
Route::post('activity-history/datatable', "ActivityHistoryController@dataTable")->name('activity-history/datatable');

Route::get('anomaly', "AnomalyController@index")->name('anomaly');
Route::any('list-menu-admin', 'MenuAdminController@index')->name('list-menu-admin');

Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Prefix</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->getMethods()[0] . "</td>";
        echo "<td>" . $value->getPath() . "</td>";
        echo "<td>" . $value->getPrefix() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
})->name('routes');
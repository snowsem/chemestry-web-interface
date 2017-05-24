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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/computing', 'HomeController@computing');
Route::resource('/materials', 'MaterialController');
Route::get('materials/{id}/create', 'MaterialController@createParameter');
Route::post('materials/{id}/create', 'MaterialController@storeParameter');
Route::resource('/parameters', 'ParameterController');
Route::resource('/coefficients', 'CoefficientController');

Route::get('api/get_material_parameters/{id}', 'HomeController@getMaterialParams');

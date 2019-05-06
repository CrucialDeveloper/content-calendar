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

Auth::routes(['register' => false]);
Route::get('/', function () {
    return redirect('/calendar');

});

Route::get('/configure', 'ConfigController@index')->middleware('auth');

Route::post('/businessunits', 'BusinessUnitController@store')->middleware('auth');
Route::patch('/businessunits/{businessUnit}', 'BusinessUnitController@update')->middleware('auth');

Route::get('/calendar', 'CalendarController@index')->middleware('auth');

Route::get('/projects', 'ProjectController@index')->middleware('auth');
Route::post('/projects', 'ProjectController@store')->middleware('auth');
Route::patch('/projects/{project}', 'ProjectController@update')->middleware('auth');
Route::delete('/projects/{project}', 'ProjectController@destroy')->middleware('auth');

Route::get('/reports', 'ReportsController@index')->middleware('auth');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// companies API routes
Route::get('/companies', 'CompaniesController@index');
Route::get('/companies/{id}', 'CompaniesController@show');
Route::post('/companies', 'CompaniesController@store');
Route::put('/companies/{id}', 'CompaniesController@update');
Route::delete('/companies/{id}', 'CompaniesController@delete');

// employees API routes
Route::get('/employees', 'EmployeesController@index');
Route::get('/employees/{id}', 'EmployeesController@show');
Route::post('/employees', 'EmployeesController@store');
Route::put('/employees/{id}', 'EmployeesController@update');
Route::delete('/employees/{id}', 'EmployeesController@delete');

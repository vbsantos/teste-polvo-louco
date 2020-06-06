<?php

use Illuminate\Support\Facades\Route;

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

// Route::resource('employee', 'EmployeesController', ['except' => ['create', 'edit']]); // REVIEW API ONLY

// Route::resource('company', 'CompaniesController', ['except' => ['create', 'edit']]); // REVIEW API ONLY

// FIXME companies routes
Route::get('/companies', 'CompaniesController@index');
Route::get('/companies/{id}', 'CompaniesController@show');
Route::post('/companies', 'CompaniesController@store');
Route::put('/companies/{id}', 'CompaniesController@update');
Route::delete('/companies/{id}', 'CompaniesController@delete');

// FIXME employees routes
Route::get('/employees', 'EmployeesController@index');
Route::get('/employees/{id}', 'EmployeesController@show');
Route::post('/employees', 'EmployeesController@store');
Route::put('/employees/{id}', 'EmployeesController@update');
Route::delete('/employees/{id}', 'EmployeesController@delete');

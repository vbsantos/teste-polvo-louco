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

// Route::resource('employees', 'EmployeesController', [
//     'names' => [
//         'index' => 'employee.index',
//         'create' => 'employee.create',
//         'store' => 'employee.store',
//         'edit' => 'employee.edit',
//         'update' => 'employee.update',
//         'destroy' => 'employee.destroy',
//     ]
// ])->middleware('auth');

// Route::resource('companies', 'CompaniesController', [
//     'names' => [
//         'index' => 'company.index',
//         'create' => 'company.create',
//         'store' => 'company.store',
//         'edit' => 'company.edit',
//         'update' => 'company.update',
//         'destroy' => 'company.destroy',
//     ]
// ])->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/employees', 'EmployeesController@index')
    ->name('employee.index')
    ->middleware('auth');

Route::get('/employees/create', 'EmployeesController@create')
    ->name('employee.create')
    ->middleware('auth');

Route::post('/employees/store', 'EmployeesController@store')
    ->name('employee.store')
    ->middleware('auth');

Route::get('/employees/{id}/edit', 'EmployeesController@edit')
    ->name('employee.edit')
    ->middleware('auth');

Route::put('/employees/{id}/update', 'EmployeesController@update')
    ->name('employee.update')
    ->middleware('auth');

Route::get('/employees/{id}/delete', 'EmployeesController@delete')
    ->name('employee.delete')
    ->middleware('auth');

Route::get('/companies', 'CompaniesController@index')
    ->name('company.index')
    ->middleware('auth');

Route::get('/companies/create', 'CompaniesController@create')
    ->name('company.create')
    ->middleware('auth');

Route::post('/companies/store', 'CompaniesController@store')
    ->name('company.store')
    ->middleware('auth');

Route::get('/companies/{id}/edit', 'CompaniesController@edit')
    ->name('company.edit')
    ->middleware('auth');

Route::put('/companies/{id}/update', 'CompaniesController@update')
    ->name('company.update')
    ->middleware('auth');

Route::get('/companies/{id}/delete', 'CompaniesController@delete')
    ->name('company.delete')
    ->middleware('auth');

Route::get('/dashboard', 'DashboardController@index')
    ->middleware('auth');

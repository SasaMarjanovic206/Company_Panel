<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SearchCompaniesController;
use App\Http\Controllers\SearchEmployeesController;
use App\Http\Controllers\CurrencyConverterController;

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

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('companies', CompanyController::class);

Route::get('employees/create/{id}', [
    'as' => 'employees.create',
    'uses' => 'App\Http\Controllers\EmployeeController@createEmployee'
]);
Route::resource('employees', EmployeeController::class, ['except' => 'create']);
// Route::post('/searchcompanies/{term}', [SearchCompaniesController::class, 'search']);
Route::post('/searchcompanies', [SearchCompaniesController::class, 'search']);
Route::post('/searchemployees', [SearchEmployeesController::class, 'search']);

Route::get('/currencyconverter', [CurrencyConverterController::class, 'converter']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanieApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\ItemApiController;
use App\Http\Controllers\Api\SellApiController;
use App\Http\Controllers\Api\SellSummaryApiController;
use App\Http\Controllers\EmployeeController;
use GuzzleHttp\Middleware;

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


Route::get('/getEmployees', [EmployeeApiController::class,'getEmployees'])->name('api.employees');
Route::get('/getCompanies', [CompanieApiController::class,'getCompanies'])->name('api.companies');
Route::get('/getItems', [ItemApiController::class,'getItems'])->name('api.items');
Route::get('/getSells', [SellApiController::class,'getSells'])->name('api.sells');
Route::get('/getSellSummaries', [SellSummaryApiController::class,'getSellSummaries'])->name('api.sellSummaries');

Route::apiResource('employees', EmployeeApiController::class)->only(['index','show']);
Route::apiResource('companies', CompanieApiController::class)->only(['index','show']);
Route::apiResource('items', ItemApiController::class)->only(['index','show']);
Route::apiResource('sells', SellApiController::class)->only(['index','show']);
Route::apiResource('sellSummaries', SellSummaryApiController::class)->only(['index','show']);




Route::post('register', 'UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@login');
Route::get('open', 'App\Http\Controllers\DataController@open');
Route::group(['middleware' => ['jwt.verify']], function(){
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('closed', 'App\Http\Controllers\DataController@closed');
    Route::post('loadEmployees', 'App\Http\Controllers\DataController@getEmployees');
    Route::post('loadEmployeesTestPermissions', 'App\Http\Controllers\DataController@getEmployeesTestPermissions')->name('loadEmployeesTestPermissions');
    Route::post('loadEmployeesTest', 'App\Http\Controllers\DataController@getEmployeesTest')->name('loadEmployeesTest');
});


// Route::get('employee', 'EmployeeController@employee');
// Route::get('employees', [EmployeeController::class,'employees']);

// Route::get('employeeAll', 'EmployeeController@employeeAuth')->middleware('jwt.verify');
// Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');




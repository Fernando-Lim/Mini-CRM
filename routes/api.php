<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanieApiController;
use App\Http\Controllers\Api\EmployeeApiController;
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

Route::apiResource('employees', EmployeeApiController::class)->only(['index','show']);
Route::apiResource('companies', CompanieApiController::class)->only(['index','show']);





Route::post('register', 'UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@login');
Route::get('open', 'App\Http\Controllers\DataController@open');
Route::group(['middleware' => ['jwt.verify']], function(){
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('closed', 'App\Http\Controllers\DataController@closed');
    Route::post('loadEmployees', 'App\Http\Controllers\DataController@getEmployees');
});


// Route::get('employee', 'EmployeeController@employee');
// Route::get('employees', [EmployeeController::class,'employees']);

// Route::get('employeeAll', 'EmployeeController@employeeAuth')->middleware('jwt.verify');
// Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');




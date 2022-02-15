<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Session;

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

// Register Off
Auth::routes([
    'register' => false
]);

// Route Root
Route::get('/', function () {
    return redirect()->route('company',Session::get('companyname')?? 'company');
});

// Route login with if-else statement
Route::get('/{company}/login', function () {
    if (Auth::check()) {
        return redirect()->route('company',Session::get('companyname')?? 'company');
    }else{
        return view('auth.login');
    }
})->name('origin');

// Route login default with if-else statement
Route::get('/company/login', function () {
    if (Auth::check()) {
        return redirect()->route('company',Session::get('companyname')?? 'company');
    }else{
        return view('auth.login');
    }
})->name('default');

// Route Auth
Auth::routes();

// Route Resource Employees
Route::resource('employees',EmployeeController::class)->except(['destroy']);

// Route get employee after login
Route::get('/{company}/employee', [App\Http\Controllers\HomeController::class, 'index'])->name('company');

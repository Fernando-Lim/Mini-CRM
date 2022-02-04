<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanieController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellSummaryController;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;

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


Auth::routes([
    'register' => false
]);

Route::get('/auth/redirect/{provider}',[SocialiteController::class,'redirect'])->name('auth.redirect');
Route::get('/auth/callback/{provider}',[SocialiteController::class,'callback'])->name('auth.callback');

Route::middleware('auth')->group(function(){
    
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => App\Http\Controllers\LanguageController::class,'switch']);

    Route::get('/', function () {
        return view('home');
    });

    Route::get('tz/{tz}', ['as' => 'tz.switch', 'uses' => App\Http\Controllers\TimezoneController::class,'switch']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('employees',EmployeeController::class)->except(['destroy']);
    Route::resource('sells',SellController::class)->except(['destroy']);
    Route::get('/employees/{employee}/destroy',[EmployeeController::class,'destroy'])->name('employees.destroy');
    
    Route::resource('companies',CompanieController::class)->except(['destroy']);
    Route::resource('items',ItemController::class)->except(['destroy']);
    Route::resource('sellSummaries',SellSummaryController::class)->except(['destroy']);
    Route::get('/items/{item}/destroy',[ItemController::class,'destroy'])->name('items.destroy');
    Route::get('/sells/{sell}/destroy',[SellController::class,'destroy'])->name('sells.destroy');

    Route::get('/companies/{company}/destroy',[CompanieController::class,'destroy'])->name('companies.destroy');
    
    Route::get('test/email', function(){
        $send_mail = 'lim.liete@gmail.com';
        dispatch(new App\Jobs\SendEmailJob($send_mail));
        dd('send mail successfully !!');
    })->name('sendEmail');
    

    

});



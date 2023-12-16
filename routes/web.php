<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth::routes();
Route::get('/login','\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','\App\Http\Controllers\Auth\LoginController@authenticate');

Route::middleware(['auth'])->group(function(){
	Route::get('/logout','\App\Http\Controllers\Auth\LoginController@logout');
	Route::get('/', function () {
	    return redirect('/dashboard');
	});
	Route::get('/dashboard',function(){
		return view('pages.dashboard');
	})->name('dashboard');
	Route::get('/users','\App\Http\Controllers\ManageUsersController@index');
	Route::post('/users','\App\Http\Controllers\ManageUsersController@update');
});

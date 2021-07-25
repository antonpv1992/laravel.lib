<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;

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

Route::get('/', 'App\Http\Controllers\MainController@index')->name('home');
Route::get('/add', 'App\Http\Controllers\MainController@create')->middleware(['auth', 'role:admin'])->name('add');
Route::get('/edit/{id}', 'App\Http\Controllers\MainController@edit')->middleware(['auth', 'role:admin'])->name('edit');
Route::get('/book/{id}', 'App\Http\Controllers\MainController@show')->name('book');
Route::post('/add', 'App\Http\Controllers\MainController@store')->middleware(['auth', 'role:admin'])->name('create');
Route::patch('/edit/{id}', 'App\Http\Controllers\MainController@update')->middleware(['auth', 'role:admin'])->name('change');
Route::delete('/delete/{id}', 'App\Http\Controllers\MainController@destroy')->middleware(['auth', 'role:admin'])->name('delete');

Route::get('/users', 'App\Http\Controllers\UserController@index')->middleware(['auth', 'role:admin'])->name('users');
Route::get('/user/{login}', 'App\Http\Controllers\UserController@show')->middleware('auth')->name('profile');
Route::get('/user/edit/{login}', 'App\Http\Controllers\UserController@edit')->middleware('auth')->name('reload');
Route::patch('/user/edit/{login}', 'App\Http\Controllers\UserController@update')->middleware('auth')->name('rewrite');
Route::delete('/user/delete/{login}', 'App\Http\Controllers\UserController@destroy')->middleware(['auth', 'role:admin'])->name('remove');


Route::get('/login', 'App\Http\Controllers\CustomAuthController@relog')->name('login');
Route::get('/registration', 'App\Http\Controllers\CustomAuthController@relog')->name('registration');
Route::post('/registration', 'App\Http\Controllers\CustomAuthController@registration')->name('signup');
Route::post('/login', 'App\Http\Controllers\CustomAuthController@login')->middleware('guest')->name('signin');
Route::post('/logout', 'App\Http\Controllers\CustomAuthController@logout')->middleware('auth')->name('logout');
Route::post('/forgot-password', 'App\Http\Controllers\CustomAuthController@remember')->middleware('guest')->name('password.email');
Route::get('/reset/{token}', 'App\Http\Controllers\CustomAuthController@forgot')->middleware('guest')->name('password.reset');
Route::post('/reset', 'App\Http\Controllers\CustomAuthController@reset')->middleware('guest')->name('password.update');
Route::get('/verify', 'App\Http\Controllers\CustomAuthController@verification')->middleware('auth')->name('verification.notice');
Route::get('/verify/{id}/{hash}', 'App\Http\Controllers\CustomAuthController@markverification')->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/verification', 'App\Http\Controllers\CustomAuthController@reverification')->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/fredirect', [FacebookController::class, 'redirectFacebook'])->name('fredirect');
Route::get('/fcallback', [FacebookController::class, 'facebookCallback'])->name('fcallback');

Route::get('/gredirect', [GoogleController::class, 'redirectToGoogle'])->name('gredirect');
Route::get('/gcallback', [GoogleController::class, 'handleGoogleCallback'])->name('gcallback');
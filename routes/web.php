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

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/projects', 'App\Http\Controllers\ProjectsController@index');
Route::post('/projects','App\Http\Controllers\ProjectsController@store')->middleware('auth');
Route::get('/projects/{project}','App\Http\Controllers\ProjectsController@show');

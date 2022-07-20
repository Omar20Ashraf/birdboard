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


Route::middleware('auth')->group(function(){

    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::controller('App\Http\Controllers\ProjectsController')->group(function(){

        Route::get('/projects', 'index');
        Route::get('/projects/create', 'create');
        Route::post('/projects', 'store');
        Route::get('/projects/{project}', 'show');
    });

    Route::controller('App\Http\Controllers\ProjectsTasksController')->group(function () {

        Route::post('/projects/{project}/tasks', 'store');
    });
});




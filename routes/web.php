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

Route::group(['prefix' => 'home'], function(){

    Route::get('/', function(){
        return view('app');
    });

    Route::resource('calendar/day', 'Calendar\DayResourceController')
    ->names('calendar.day')->only(['index','update','store','destroy']);
    
    Route::resource('calendar/hour', 'Calendar\HourResourceController')
    ->names('calendar.hour')->only(['show','update','store','destroy']);

});
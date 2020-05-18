<?php

use Illuminate\Support\Facades\Route;
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



Auth::routes();

Route::get('/','HomeController@index')->name('home');

Route::get('/admin', 'HomeController@index')->name('home');
//simple table
Route::get('/simple', 'HomeController@simple')->name('simple');
//delete table House
Route::delete('/simple/{id_house?}','HomeController@destroy')->name('delete');
//Update House layout
Route::get('/update/{id_house?}','HomeController@HouseEdit')->name('House-edit');
//Update house
Route::post('/MakeUpdate/{id_house?}','HomeController@EditHouse')->name('Edit-House');
//Add house layout
Route::get('/add-house','HomeController@HouseAdd')->name('add-house');
//Add house
Route::post('/add-house','HomeController@addHouse')->name('add-house-now');

Route::post('/searchList', 'HomeController@fetch')->name('searchList');

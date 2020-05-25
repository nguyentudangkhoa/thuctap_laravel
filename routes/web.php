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

Route::delete('delete/{id_location?}','HomeController@destroyLocation')->name('delete-Location');
//update locaiton layout
Route::get('/update-location/{id_location?}','HomeController@updateLocation')->name('update-location');

Route::patch('/MakeUpdateLocation/{id_location?}','HomeController@LocationUpdate')->name('make-update-location');

//add location
Route::get('/add-location','HomeController@LocationAdd')->name('add-location');

Route::post('/add-location-now','HomeController@AddLocation')->name('add-location-now');

//user update layout
Route::get('/update-user/{user_id?}','HomeController@UserUpdate')->name('user-update');

Route::patch('/make-update-user/{user_id?}','HomeController@UpdateUser')->name('make-user-update');
//delete user
Route::delete('delete-user/{user_id?}','HomeController@DestroyUser')->name('delete-user');
//validate location ajax
Route::post('/validate-location','ThucTap@LocationVali')->name('validate-location');


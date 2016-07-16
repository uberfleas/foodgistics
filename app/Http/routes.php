<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
// 	$people = ["Daniel","Ginger","Hazel","Rebecca"];
//     return view('welcome', compact('people'));
// });

//authentication routes

Route::auth();

Route::get('/', 'HomeController@index');


//general routes

//Route::get('/', 'PagesController@home');


//model routes

//--items routes

Route::get('items', 'ItemController@index');

Route::post('items/store', 'ItemController@store');

Route::get('items/{item}', 'ItemController@show');

Route::get('items/{item}/edit', 'ItemController@edit');

Route::patch('items/{item}', 'ItemController@update');

Route::get('items/{item}/delete', 'ItemController@delete');



//test or reference routes


Route::get('feedback', 'PagesController@feedback');

Route::get('about', 'PagesController@about');

Route::get('cards', 'CardsController@index');

Route::get('cards/{card}', 'CardsController@show');

Route::post('cards/{card}/notes', 'NotesController@store');

Route::get('notes/{note}/edit', 'NotesController@edit');

Route::patch('notes/{note}', 'NotesController@update');


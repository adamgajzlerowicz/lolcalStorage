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

Route::get('/', [
    'as' => 'notes.index', 'uses' => 'NoteController@index'
]);
Route::get('/api/store', [
    'as' => 'notes.store', 'uses' => 'APINoteController@store'
]);
Route::get('/delete', [
    'as' => 'notes.delete', 'uses' => 'NoteController@delete'
]);
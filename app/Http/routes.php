<?php
use Illuminate\Http\Request;

Route::get('/', [
    'as' => 'notes.index', 'uses' => 'NoteController@index'
]);
Route::get('/api/store', [
    'as' => 'notes.store', 'uses' => 'APINoteController@store'
]);
Route::post('/api/store', function(Request $request){
        \App\Note::create($request->all());

});
Route::get('/delete', [
    'as' => 'notes.delete', 'uses' => 'NoteController@delete'
]);
Route::get('/api/all', function(){
    return \App\Note::orderBy('id','desc')->limit(15)->get();
});

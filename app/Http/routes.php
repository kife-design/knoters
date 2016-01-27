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

get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
get('/editor/{hash}', ['as' => 'editor', 'uses' => 'EditorController@index']);
post('/submit', ['as' => 'submit', 'uses' => 'SourceController@store']);


//The routes for the api
Route::group(['prefix' => 'projects/{projectId}'], function () {
    get('notes', ['as' => 'notes.index', 'uses' => 'NotesController@index']);
    get('notes/search', ['as' => 'notes.search', 'uses' => 'NotesController@search']);
    post('notes', ['as' => 'notes.store', 'uses' => 'NotesController@store']);
});

put('notes/{noteId}', ['as' => 'notes.edit', 'uses' => 'NotesController@update']);
delete('notes/{noteId}', ['as' => 'notes.destroy', 'uses' => 'NotesController@destroy']);

Route::group(['prefix' => 'notes/{noteId}'], function () {
    get('replies', ['as' => 'notes.replies.index', 'uses' => 'RepliesController@index']);
    post('replies', ['as' => 'notes.replies.store', 'uses' => 'RepliesController@store']);
});

put('replies/{replyId}', ['as' => 'notes.replies.update', 'uses' => 'RepliesController@update']);


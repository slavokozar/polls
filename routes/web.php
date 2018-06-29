<?php

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

Route::get('/', 'HomeController@index');

Route::get('/polls', 'PollController@index');
Route::get('/polls/{poll}', 'PollController@show');
Route::post('/polls/{poll}', 'PollController@vote');

Route::get('/manage/polls', 'Management\PollController@index');
Route::get('/manage/polls/create', 'Management\PollController@create');
Route::post('/manage/polls', 'Management\PollController@store');
Route::get('/manage/polls/{poll}', 'Management\PollController@show');
Route::get('/manage/polls/{poll}/edit', 'Management\PollController@edit');
Route::put('/manage/polls/{poll}', 'Management\PollController@update');
Route::delete('/manage/polls/{poll}', 'Management\PollController@destroy');

Route::get('/manage/polls/{poll}/options', 'Management\OptionController@index');
Route::get('/manage/polls/{poll}/options/create', 'Management\OptionController@create');
Route::post('/manage/polls/{poll}/options', 'Management\OptionController@store');
Route::get('/manage/polls/{poll}/options/{option}', 'Management\OptionController@show');
Route::get('/manage/polls/{poll}/options/{option}/edit', 'Management\OptionController@edit');
Route::put('/manage/polls/{poll}/options/{option}', 'Management\OptionController@update');
Route::delete('/manage/polls/{poll}/options/{option}', 'Management\OptionController@destroy');


Auth::routes();





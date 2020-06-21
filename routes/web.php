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

Route::get('/', function () {
    return view('app.home');
});

Route::get('user/add', 'UsersController@create');

Route::post('login', 'UsersController@store');

Route::get('user/login', 'UsersController@getAuth');

Route::get('index', 'QuestionsController@indexQuestion');

Route::post('index', 'UsersController@postAuth');

Route::get('add', 'QuestionsController@getAddQuestion');

Route::post('add', 'QuestionsController@postAddQuestion');

Route::get('user/edit', 'UsersController@getEditUser');

Route::post('user/edit', 'UsersController@postEditUser');

Route::get('user/logout', 'UsersController@getLogOut');

Route::get('view/{id}', 'QuestionsController@getViewQuestion');

Route::post('answers/add', 'AnswersController@AddAnswers');

Route::get('answers/delete/{id}', 'AnswersController@getDeleteAnswer');

Route::get('questions/delete/{id}', 'QuestionsController@getDeleteQuestion');


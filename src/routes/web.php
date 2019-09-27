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
Route::get('/', 'IndexController@index')->name('home');
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login.post');
Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@register')->name('register.post');

Route::group(['middleware' => ['auth']], function () {
    Route::get('posts', 'PostController@index')->name('posts');
    Route::get('posts/create', 'PostController@create')->name('create.get');
    Route::get('posts/{post}/edit', 'PostController@edit')->name('edit.get');
    Route::post('posts/{post}/update', 'PostController@update')->name('update.post');
    Route::post('posts', 'PostController@store')->name('create.post');
    Route::delete('posts/{post}', 'PostController@delete')->name('delete.post');
});

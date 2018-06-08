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
Auth::routes();

Route::get('/','PagesController@root')->name('root');
Route::resource('topics', 'TopicsController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);

Route::get('topics', 'PagesController@community')->name('topics');
Route::get('docs', 'PagesController@docs')->name('docs');
Route::get('life', 'PagesController@life')->name('life');
Route::get('works', 'PagesController@works')->name('works');
Route::get('about', 'PagesController@about')->name('about');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('articles/{article}', 'ArticleController@show')->name('article.show');
Route::get('notes/{note}', 'NoteController@show')->name('notes');


Route::middleware(['auth'])->group(function (){
    Route::resource('users','UsersController',['only'=>['show','update','edit']]);
    Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
    Route::resource('replies', 'RepliesController', ['only' => [ 'store','destroy']]);
    Route::resource('notifications','NotificationsController',['only'=>['index']]);
    Route::post('upload_image','TopicsController@uploadImage')->name('topics.upload_image');
    Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

    Route::get('article', 'ArticleController@create')->name('article.create');
    Route::post('articles', 'ArticleController@store')->name('article.store');
    Route::put('articles/{article}', 'ArticleController@update')->name('article.update');
    Route::get('articles/{article}/edit', 'ArticleController@edit')->name('article.edit');
    Route::delete('articles/{article}', 'ArticleController@destroy')->name('article.delete');

    Route::get('/search', 'PagesController@search')->name('search');

});




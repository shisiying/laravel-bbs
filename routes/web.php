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
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('articles/{article}', 'ArticleController@show')->name('article.show')->middleware('can:view,article');
Route::get('notes/{note}', 'NoteController@show')->name('notes');
Route::get('auth/oauth', 'Auth\AuthController@oauth')->name('auth.oauth');
Route::get('auth/oauthcallback', 'Auth\AuthController@oauthcallback')->name('auth.oauthcallback');
Route::get('auth/wechatcallback', 'Auth\AuthController@wechatcallback')->name('auth.wechatcallback');


Route::middleware(['auth'])->group(function (){
    Route::get('about', 'PagesController@about')->name('about');
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
    Route::get('getchapters', 'ArticleController@getChapters')->name('chapters.getChapters');

    Route::get('/search', 'PagesController@search')->name('search');
    Route::get('topic/search', 'PagesController@topicSearch')->name('topics.search');

    Route::get('note/purchase/{note}', 'OrderController@purchase')->name('order.purchase');


});




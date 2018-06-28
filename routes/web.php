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

    Route::get('payment/{order}', 'OrderController@alipayment')->name('order.alipay');

    Route::get('alicallback', 'OrderController@alicallback')->name('order.alipaycallback');
    Route::get('alinotify', 'OrderController@alinotify')->name('order.alinotify');


});
//?charset=GBK&out_trade_no=20180628024224918722&method=alipay.trade.page.pay.return&total_amount=50.00&sign=hRTeaD29Ug%2BoC%2BSIvxyZmg14E9XBPS5MGO8ThmLFLeeMeCPwLj0kOZw5zbZ8DlvoerZk9uuqpf5DsZzAGSdKW2WROTJEfzKkEIyqjMcWHOBfXnxR%2FpN1ka4yw4cGJxzWer92a65N59WhIrGigDZhWC%2BeKqeCaDebOpHhWNFVPM34jD8lErdf6GE2SuqxyBFH9MXdUMk2ygGOm72znbWKQd18vitX7%2FGY%2Fv3RyR9fPECW2KdTRuUjSxViF7mZvX6y3uOuyoQwlKuxiwhTpLInCETh8DmUz05y6wkxQ5xm8%2BtFB4jezUktuzozEajw1iGzc8TpFJT7QCT%2FraXrBTSwUA%3D%3D&trade_no=2018062821001004700201780936&auth_app_id=2016091400506411&version=1.0&app_id=2016091400506411&sign_type=RSA2&seller_id=2088102175536046&timestamp=2018-06-28+10%3A46%3A32



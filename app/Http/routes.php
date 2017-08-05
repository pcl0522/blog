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

Route::get('/', function () {
    echo 'get';
});

Route::delete('/to', function () {
    echo 'delete';
});
Route::options('/to', function () {
    echo 'options';
});


Route::group(['namespace' => 'Admin','prefix'=>'admin'], function () {
    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');

});

Route::group(['middleware'=>['admin.login'],'namespace' => 'Admin','prefix'=>'admin'], function () {
    Route::get('', 'IndexController@index');
    Route::get('index', 'IndexController@index');
    Route::get('logout','IndexController@logout');
    Route::get('indexInfo', 'IndexController@indexInfo');
    Route::any('updatepwd', 'IndexController@updatepwd');

    Route::resource('category','CategoryController');
    Route::post('cate/changeSort', 'CategoryController@changeSort');

    Route::resource('article','ArticleController');
    Route::resource('links','LinksController');
    Route::post('links/changeSort', 'LinksController@changeSort');

});


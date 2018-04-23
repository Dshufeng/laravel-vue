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


Route::group(['middleware' => 'my'], function () {
    Route::get('/admin/index', function () {
        return view('welcome');
    });
    Route::post('/admin/post/article','Admin\ArticleController@postArticle');
    Route::post('/admin/delete/article','Admin\ArticleController@deleteArticle');

    // category
    Route::resource('admin/category', 'Admin\CategoryController');
});

Route::get('/login/index', 'LoginController@index');
Route::post('/login/index', 'LoginController@login');
Route::post('/login/check', 'LoginController@check');
Route::get('/login/logout', 'LoginController@logout');
Route::get('/',function(){
    return view('index');
});
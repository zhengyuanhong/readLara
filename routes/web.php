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


use Illuminate\Support\Facades\Route;

//首页
Route::get('/','IndexController@index');
Route::get('/books','IndexController@books');
Route::post('/create-book','IndexController@createBook');

//文章
Route::get('/write','ArticleController@write');
Route::post('/article-add','ArticleController@add');
Route::get('/detail','ArticleController@detail');
//评论
Route::post('/reply','ArticleController@reply')->middleware('checkAuth');


//个人信息
Route::prefix('users')->namespace('User')->group(function (){
    Route::get('info','UserInfoController@userInfo')->middleware('checkAuth');
    Route::get('set','UserInfoController@set')->middleware('checkAuth');
    Route::get('message','UserInfoController@message')->middleware('checkAuth');
    Route::get('/','UserInfoController@home');
});

//登陆、注册、退出
Route::namespace('User')->group(function(){
    Route::get('/login','UserController@goToLogin');
    Route::post('/login','UserController@login');
    Route::get('/reg','UserController@goToReg');
    Route::post('/reg','UserController@reg');
    Route::get('/logout','UserController@logout');
});




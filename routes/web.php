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

//Route::get('/', function () {
//    return view('welcome');
//});

//登录和注销
Route::get('login', 'Login\LoginsController@create')->name('login');//登录表单
Route::post('login', 'Login\LoginsController@store')->name('login');//登录验证
Route::delete('logout', 'Login\LoginsController@destroy')->name('logout');//注销
//商家注册
Route::get('register', 'Register\RegistersController@create')->name('register');//注册
Route::post('register', 'Register\RegistersController@store')->name('register');
//首页
Route::resource('home','Main\HomesController');
//完善店铺信息
Route::resource('goinfo','Main\GoinfoController');
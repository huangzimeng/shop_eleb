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

Route::get('/',function (){
    return view('Logins.create');
});

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
//修改密码
Route::get('modify','Main\HomesController@modify')->name('modify');
Route::post('modify','Main\HomesController@modify')->name('set_modify');
//菜品分类
Route::resource('goods_category','Main\GoodscategoryController');
//菜单列表
Route::resource('goods_list','Main\GoodslistsController');
//webuploader文件上传
Route::post('/upload','Main\UploaderController@upload');
//查看活动
Route::get('/activity','Main\ActivityController@index')->name('activity.index');
//查看活动详情
Route::get('/activity/{activity}','Main\ActivityController@show')->name('activity.show');
//查看订单列表
Route::get('/order','Main\OrderController@index')->name('order');
//查看订单
Route::get('/order/{order}','Main\OrderController@show')->name('order.show');
//处理订单
Route::get('/orders/{deal}','Main\OrderController@deal')->name('orders.deal');//发货
Route::get('/orderss/{cancel}','Main\OrderController@cancel')->name('orders.cancel');//取消
//统计
Route::get('/order_count','Main\OrderController@count')->name('order.count');//订单
Route::get('/goods_count','Main\GoodslistsController@count')->name('goods.count');//菜品
//抽奖
Route::get('/show_prize','Main\PrizeController@show_prize')->name('show_prize');
//报名抽奖
Route::get('/signup/{signup}','Main\PrizeController@signup')->name('signup');
//查看中奖名单
Route::get('/show_members/{show_members}','Main\PrizeController@show_members')->name('show_members');


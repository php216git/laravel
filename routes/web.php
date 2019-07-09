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























































































// 后台登录和退出
Route::resource('/adminlogin','Admin\AdminLoginController');
 


Route::group(['middleware'=>'login'],function(){
	// 模板继承的练习  搭建后台
	Route::resource('/admin','Admin\AdminController');


	// 后台管理员模块
	Route::resource('/adminuser','Admin\AdminuserController');
	// 分配角色
	Route::get('/adminrole/{id}','Admin\AdminuserController@role');
	// 保存角色
	Route::post('/saverole','Admin\AdminuserController@saverole');

	// 角色管理
	Route::resource('/adminroles','Admin\RoleController');
	// 分配权限
	Route::get('/adminauth/{id}','Admin\RoleController@adminauth');
	// 保存权限
	Route::post('/saveauth','Admin\RoleController@saveauth');

	// 权限管理
	Route::resource('/auth','Admin\AuthController');



	// 后台轮播图路由
	Route::resource('/adminbanner','Admin\BannerController');

	// 友情连接
	Route::resource('/adminyouqing','Admin\YouqingController');
});


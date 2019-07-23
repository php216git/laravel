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

	// 公告管理 
	Route::resource('/adminarticles','Admin\ArticleController');

	//ajax删除  
	Route::get("/del","Admin\ArticleController@del");

	//后台的用户模块(模型类) 
	Route::resource("/adminusers","Admin\UsersController");
	//获取收货地址 
	Route::get("/adminaddress/{id}","Admin\UsersController@address");

	// 后台无限分类模块 
	Route::resource("/admincates","Admin\CatesController");

	// 后台广告 
	Route::resource("/adminadvert","Admin\AdvertController");
	
	// 后台商品模块 
	Route::resource("/adminshops","Admin\ShopsController");

	// 后台底部管理模块
	Route::resource("/dibu","Admin\DibuController");
	
	// 后台订单模块
	Route::resource("/adminorders","Admin\OrdersController");
	
	// 后台评论模块
	Route::resource("/admincomment","Admin\CommentController");
	
	
});
	
	// 赵文旭 
	
	//发送邮件测试一  发送原始字符窜 
	Route::get("/send","Home\RegisterController@send");
	//发送邮件测试二  发送视图 
	Route::get("/sends","Home\RegisterController@sends");
	Route::get("/a","Home\RegisterController@a");

	// 校验码测试 
	Route::get("/code","Home\RegisterController@code");

	// 一邮箱注册 引入校验码 
	Route::resource("/homeregister","Home\RegisterController");
 
	// 手机号注册
	Route::get("/checkphone","Home\RegisterController@checkphone");

	// 前台首页 
	Route::resource("/homeindex","Home\IndexController");







	// 谢明聪 
	

	// 调用短信接口  谢 
	Route::get("/sendphone","Home\RegisterController@sendphone");
	// 检测校验码
	Route::get("/checkcode","Home\RegisterController@checkcode");
	Route::post("/registerphone","Home\RegisterController@registerphone");
	// 前台登录 
	Route::resource("/homelogin","Home\LoginController");
	// 退出路由 
	Route::get("/logout","Home\LoginController@logout");
	// 忘记密码 然后发送邮箱 
	Route::get("/forget","Home\LoginController@forget");
	Route::post("/doforget","Home\LoginController@doforget");
	// 重置密码 
	Route::get("/reset","Home\LoginController@reset");
	// 执行密码重置 
	Route::post("/doreset","Home\LoginController@doreset");




	//陈洋洋
	
	// 前台个人中心路由
	Route::resource('/geren','Home\GerenController');

	// 重置密码 
	Route::get("/homeedit/{id}","Home\EditController@edit");
	// 执行密码重置 
	Route::post("/homeupdate/{id}","Home\EditController@update");


	// 前台个人资料 
	Route::get('/home_edit/{id}','Home\HomeEditController@edit');

	// 前台执行用户修改 
	Route::post('/home_update/{id}','Home\HomeEditController@update');


	// 前台公告
	Route::get('/homegonggao/{id}','Home\GonggaoController@index');

	// 个人资料内的地址 
	ROute::get('/dizhi','Home\DizhiController@index');

	// 个人城市级联数据
	Route::get("/create","Home\DizhiController@create");

	Route::post("/gerendizhi/insert","Home\DizhiController@insert");

	Route::get("/shanchu/{id}","Home\DizhiController@shanchu");

	
	
	// 谢明聪
	 
	// 中间件 
	Route::group(['middleware'=>"homelogin"],function(){
		//购物车控制器
		Route::resource("/homecart","Home\CartController");
		// 删除所有的购物车数据
		Route::get("/alldelete","Home\CartController@alldelete");
		// 购物车 减操作
		Route::get("/cartupdatee","Home\CartController@cartupdatee");
		// 购物车 加操作
		Route::get("/cartupdate","Home\CartController@cartupdate");
		// 购物车 勾选购物栏
		Route::get("/carttot","Home\CartController@carttot");
		
			// 结算
		Route::get("/jiesuan","Home\OrdersController@jiesuan");
		// 结算页(订单的插入)
		Route::any("/order/insert","Home\OrdersController@insert");
		// 购物删除地址
		Route::any("/gowu/shanchu/{id}","Home\OrdersController@shanchu");
		// 城市级联数据
		Route::get("/address","Home\AddressController@address");

		// 收货地址 
		Route::post("/addresss/insert","Home\AddressController@insert");
		// 选择收货地址
		Route::get("/choose","Home\AddressController@choose");
		// 下单
		Route::post("/order/create","Home\OrdersController@create");
		// 支付宝支付完毕跳转到商户界面
		Route::get("/returnurl","Home\OrdersController@returnurl");

	});









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

/**后台**/

//登录
Route::any('admin/boomshakalaka/login','Admin\LoginController@login');

//登录验证码
Route::get('admin/code','Admin\LoginController@code');

Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){

	//后台首页
	Route::get('index','IndexController@index');

	//后台首页右侧main页面
	Route::get('info','IndexController@info');

	//后台首页退出
	Route::get('quit','IndexController@quit');

	//后台首页修改密码
	Route::any('pass','IndexController@pass');

	//新增用户
	Route::any('user','IndexController@user');

	//用户列表
	Route::any('userList','IndexController@userList');

	//修改前台权限状态
	Route::post('user/changeHomeStatus', 'IndexController@changeHomeStatus');

	//修改后台权限状态
	Route::post('user/changeAdminStatus', 'IndexController@changeAdminStatus');

	//文章分类：资源路由
	Route::resource('category','CategoryController');	
	//文章分类列表：修改排序
	Route::post('cate/changeorder', 'CategoryController@changeOrder');	
	//文章分类列表：修改状态
	Route::post('cate/changestatus', 'CategoryController@changeStatus');

	//文章：资源路由
	Route::resource('article','ArticleController');	
	//文章缩略图异步上传
	Route::any('upload','CommonController@upload');	
	//文章列表：修改状态
	Route::post('article/changestatus', 'ArticleController@changeStatus');
	//文章列表：修改排序
	Route::post('article/changeorder', 'ArticleController@changeOrder');

	//说说：资源路由
	Route::resource('say','SayController');
	//说说列表：修改排序
	Route::post('say/changeorder', 'SayController@changeOrder');			

	//自定义导航
	Route::resource('nav', 'NavController');
	//自定义导航列表：修改排序
	Route::post('nav/changeorder', 'NavController@changeOrder');

	//网站配置项
	Route::resource('config', 'ConfigController');
	//网站配置项：修改排序
	Route::post('config/changeorder', 'ConfigController@changeOrder');
	//网站配置：把数据库中的值写入配置文件
	Route::get('config/putfile', 'ConfigController@putFile');
	//网站配置：列表页修改各个配置项内容
	Route::post('config/changecontent', 'ConfigController@changeContent');	 	

});

/**前台**/

Route::get('/', 'Home\IndexController@index');//首页
Route::get('/c/{cate_id}', 'Home\IndexController@cate');//分类
Route::get('/a/{art_id}', 'Home\IndexController@article');//文章
Route::get('/t', 'Home\IndexController@tool');//tool
Route::get('/s', 'Home\IndexController@say');//say
Route::get('/st', 'Home\IndexController@store');//store

Route::any('/login', 'Home\LoginController@login');//diary登录页面
Route::group(['middleware'=>['home.login'],'namespace'=>'Home'],function(){

	Route::get('d', 'IndexController@diaryList');//diary列表
	Route::get('d/{art_id}', 'IndexController@diary');//diary详情
});


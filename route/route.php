<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/[:name]', 'index/hello');

//首页的路由
Route::get('/', 'index/index');

Route::get('demo', 'index/demo');

//方式2，数组方式注册路由分组，都支持跨域请求
Route::group('',[
    'conf'=>'appConf',
    'env'=>'appEnv',
    'serv'=>'appServ',
    'ent/:name'=> 'appEnt',
	
])->method('GET|POST')
  ->header('Access-Control-Allow-Origin','*')
  ->header('Access-Control-Allow-Credentials', 'true')
  ->allowCrossDomain();
  
//解析前端发送的由‘system’发起的路由字符串	
Route::group('system',[
    ''=>'index',
	'index'=>'index',
	'conf'=>'conf',
    'env'=>'env',
    'serv'=>'serv',	
])->method('GET|POST')
	//admin模块/system控制器/[操作]
	->prefix('admin/system/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	->allowCrossDomain();

//解析前端发送的由‘supply’发起的路由字符串	
Route::group('supply',[
    ''=>'index',
	'index'=>'index',
	'pat/[:oprt]'=>'pat',
	//'pat'=>'pat',
	'pro'=>'pro',
	'sol'=>'sol',
	'ach'=>'ach',
    	
])->method('GET|POST')
	//admin模块/supply控制器/[操作]
	->prefix('admin/supply/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	//->header('Content-Type','application/json')
  	//->header('Content-Type','application/x-www-form-urlencoded;charset=UTF-8')
  	//->header('Content-Type','multipart/form-data;boundary='.'---xx')
  	//->header('Content-Type','multipart/form-data')
  	->allowCrossDomain();
	
//解析前端发送的由‘demand’发起的路由字符串	
Route::group('demand',[
    ''=>'index',
	'index'=>'index',
	'com'=>'com',
	'gov'=>'gov',
	'edu'=>'edu',
	'dev'=>'dev',
	'ngo'=>'ngo',
	'person'=>'person',   	
])->method('GET|POST')
	//admin模块/supply控制器/[操作]
	->prefix('admin/demand/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	->allowCrossDomain();
	
//解析前端发送的由‘project’发起的路由字符串	
Route::group('project',[
    ''=>'index',
	'index'=>'index',
	'com'=>'com',
	'dev'=>'dev',
	'ngo'=>'ngo',
	'person'=>'person',
	
    	
])->method('GET|POST')
	//admin模块/supply控制器/[操作]
	->prefix('admin/project/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	->allowCrossDomain();
	
//解析前端发送的由‘mentor’发起的路由字符串	
Route::group('mentor',[
    ''=>'index',
	'index'=>'index',
	/* //研发
	'res_des/[:type]'=>'res_des',
	//管理
	'manage/[:type]'=>'manage', */
	'material/[:oprt]'=>'material',
	'computer/[:oprt]'=>'computer',
	'strategy/[:oprt]'=>'strategy',
	'finance/[:oprt]'=>'finance',
	'operation/[:oprt]'=>'operation',
	'uploadFile/[:id]'=>'uploadPicture',
    	
])->method('GET|POST')
	//admin模块/supply控制器/[操作]
	->prefix('admin/mentor/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	->allowCrossDomain();
	
//解析前端发送的由‘expert’发起的路由字符串	
Route::group('expert',[
    ''=>'index',
	'index'=>'index',
	'com'=>'com',
	'gov'=>'gov',
	'edu'=>'edu',
	'dev'=>'dev',
	'ngo'=>'ngo',
	'person'=>'person',
    	
])->method('GET|POST')
	//admin模块/supply控制器/[操作]
	->prefix('admin/expert/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	->allowCrossDomain();
	
//解析前端发送的由‘uploads’发起的路由字符串	
/* Route::group('uploads',[
    ''=>'index',
    '/'=>'index',
	'index'=>'index',
	'pictures/[:type]'=>'picture',
	    	
])->method('GET|POST')
	//uploads模块/index控制器/[操作]
	->prefix('uploads/index/')
  	->header('Access-Control-Allow-Origin','*')
  	->header('Access-Control-Allow-Credentials', 'true')
  	->allowCrossDomain(); */
  
////支持跨域请求
//Route::get('conf', 'index/appConfig')
//      ->header('Access-Control-Allow-Origin','*')
//      ->header('Access-Control-Allow-Credentials', 'true')
//      ->allowCrossDomain();
//
////支持跨域请求
//Route::get('env', 'index/appEnv')
//      ->header('Access-Control-Allow-Origin','*')
//      ->header('Access-Control-Allow-Credentials', 'true')
//      ->allowCrossDomain();
//
////支持跨域请求
//Route::get('serv', 'index/servInfo')
//      ->header('Access-Control-Allow-Origin','*')
//      ->header('Access-Control-Allow-Credentials', 'true')
//      ->allowCrossDomain();
//
////支持跨域请求
//Route::rule('ent/:name', 'index/entInfo','GET|POST')
//      ->header('Access-Control-Allow-Origin','*')
//      ->header('Access-Control-Allow-Credentials', 'true')
//      ->allowCrossDomain();

//设置全局MISS路由
Route::miss(function() {
  return '<br><h1 style="text-align:center"> 404 not found!</h1>';
});

return [

];

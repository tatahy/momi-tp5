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
    'ent/:name'=> 'appEnt'
])->method('GET|POST')
  ->header('Access-Control-Allow-Origin','*')
  ->header('Access-Control-Allow-Credentials', 'true')
  ->allowCrossDomain();
  
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

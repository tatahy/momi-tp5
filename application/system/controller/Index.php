<?php
namespace app\system\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

class Index extends Controller
{
    private $data=['ent' => 'system','fields'=>[],'items'=>[]];
	private $number=['conf'=>0,'env'=>0,'serv'=>0];
	
	public function index()
    {
  		$arr=['conf'=>count(fn_com_ksort_arr(Config::get())),
				'env'=>count(fn_com_ksort_arr(Env::get())),
				'serv'=>count(fn_com_ksort_arr($_SERVER))
			];
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>'; 
		$this->number=array_merge($this->number,$arr);
		
    	return json_encode(array_merge(['num'=>$this->number],$this->data));

	}
	
	public function conf()
    {
        //读取所有的配置参数
        //return dump(Config::get());
        $arr=fn_com_ksort_arr(Config::get());
        return json_encode($arr);
    }

    public function env()
    {
        //读取所有的环境变量
        //return dump(Env::get());
        $arr=fn_com_ksort_arr(Env::get());
        return json_encode($arr);
    }

    public function serv()
    {
        //读取所有的服务器参数
        //return dump($_SERVER);
        $arr=fn_com_ksort_arr($_SERVER);
        return json_encode($arr);
    }
}

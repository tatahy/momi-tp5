<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

use app\index\model\Patinfo as Pat;

class Index extends Controller
{
    public function index()
    {
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
        //绝对路径指定模板文件，也是前端执行的入口文件
        return $this->fetch(Env::get('ROOT_PATH') . '/public/main.html'); 
    }
    
    private function kSortArr($arr=[])
    {
      if(count($arr)){
        ksort($arr);
        return $arr;
      }
      
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
    
    public function demo()
    {
      
      return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>'; 
    }
    
    public function appConf()
    {
        //读取所有的配置参数
        //return dump(Config::get());
        $arr=$this->kSortArr(Config::get());
        return json_encode($arr);
    }

    public function appEnv()
    {
        //读取所有的环境变量
        //return dump(Env::get());
        $arr=$this->kSortArr(Env::get());
        return json_encode($arr);
    }

    public function appServ()
    {
        //读取所有的服务器参数
        //return dump($_SERVER);
        $arr=$this->kSortArr($_SERVER);
        return json_encode($arr);
    }
    
    public function appEnt(Request $request)
    {
        $name=($request->has('name'))?$request->param('name'):'pat';
        $entType = ['pat', 'pro', 'the'];
        $result = ['ent' => $name,'list'=>[]];

        if ($name == 'pat')
        {
            $result['list']= Pat::getPatList();
        }
        
        return json_encode($result);
    }
}

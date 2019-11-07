<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

class Supply extends Controller
{
    private $data=['ent' => 'system','fields'=>[],'items'=>[]];
	/* private $itemsTotal=[
				['name'=>'sys-conf','value'=>0],
				['name'=>'sys-env','value'=>0],
				['name'=>'sys-serv','value'=>0],
			]; */
	private $itemsTotal=[
				'system-conf'=>0,
				'system-env'=>0,
				'system-serv'=>0,
			];
	
	public function __construct()
	{
		$arr=$this->itemsTotal;
		
		$arr['system-conf']=count(fn_com_ksort_arr(Config::get()));
		$arr['system-env']=count(fn_com_ksort_arr(Env::get()));
		$arr['system-serv']=count(fn_com_ksort_arr($_SERVER));
		
		$this->itemsTotal=$arr;
		
	}
	
	public function index()
    {
  		
    	return json_encode(array_merge(['itemsTotal'=>$this->itemsTotal],$this->data));

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

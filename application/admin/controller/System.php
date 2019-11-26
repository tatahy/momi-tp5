<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

class System extends Controller
{
    
	const CATEGORY=['conf','env','serv'];
	const ENT='system';
	
	private $brief=[];
	private $data=[];
	
	private function _setBrief()
	{
		$arr=[];
		$num=0;
		
		foreach(self::CATEGORY as $key=>$val){
			if($val=='serv')$num=count($_SERVER);
			if($val=='conf')$num=count(Config::get());
			if($val=='env')$num=count(Env::get());
			
			$arr[$key]=[
				'name'=>$val,	
				'routeStr'=>self::ENT.'-'.$val,	
				'total'=>$num,	
			];
		}
		
		return ['items'=>$arr];
		
	}
	
	public function __construct()
	{

		$this->brief=$this->_setBrief();
		
		$this->data=[
			'ent' => self::ENT,
			'sysEnt'=>'',
			'fields'=>[],
			'items'=>[]
		];
		
	}
	
	public function index()
    {
  		
    	return json_encode(array_merge(
									$this->data,
									['brief'=>$this->brief]
								)
							);

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

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
	private $itemsTotal=[];
	
	private function _setBrief()
	{
		$arr=[
			'name'=>self::CATEGORY,
			'routeStr'=>[],
			'total'=>[]
		];
		
		foreach(self::CATEGORY as $key=>$val){
			$param=$_SERVER;
			if($val=='conf')$param=Config::get();
			if($val=='env')$param=Env::get();
			
			$arr['routeStr'][$key]=self::ENT.'-'.$val;
			$arr['total'][$key]=count($param);
		}
		
		return $arr;
		
	}
	
	public function __construct()
	{

		$this->brief=$this->_setBrief();
		
		/* $arr['system-conf']=count(fn_com_ksort_arr(Config::get()));
		$arr['system-env']=count(fn_com_ksort_arr(Env::get()));
		$arr['system-serv']=count(fn_com_ksort_arr($_SERVER));
		 */
		
		$this->data=[
			'ent' => self::ENT,
			'sysEnt'=>'',
			'fields'=>[],
			'items'=>[]
		];
		
		$this->itemsTotal=array_combine($this->brief['routeStr'],$this->brief['total']);
			
		//return json_encode($this->itemsTotal);
		
	}
	
	public function index()
    {
  		
    	return json_encode(array_merge(
									$this->data,
									['itemsTotal'=>$this->itemsTotal],
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

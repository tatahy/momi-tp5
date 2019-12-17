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
	
	private $data=[];
	
	private function _setDataItems()
	{
		$arr=[];
		$num=0;
		
		foreach(self::CATEGORY as $key=>$val){
			if($val=='serv')$num=count($_SERVER);
			if($val=='conf')$num=count(Config::get());
			if($val=='env')$num=count(Env::get());
			
			$arr[$key]=[
				'key'=>$val,	
				'routeStr'=>self::ENT.'-'.$val,	
				'total'=>$num,	
			];
		}
		
		return $arr;
		
	}
	private function _setListsArr($arr)
	{
		$arr=fn_com_ksort_arr($arr);
		
		$this->data['lists']=[];
		foreach($arr as $key=>$val){
			array_push($this->data['lists'], ['key'=>$key,'value'=>$val]);
			
		}
		
		return $this->data['lists'];
	}
	public function __construct()
	{
		$this->data=[
			'ent' => self::ENT,
			'sysEnt'=>'',
			'fields'=>[],
			'items'=>$this->_setDataItems(),
			'lists'=>[]
		];
		
	}
	
	public function index()
    {
  		
    	return json_encode($this->data);

	}
	
	public function conf()
    {
        //读取所有的配置参数
        /* $arr=fn_com_ksort_arr(Config::get());
		$this->data['lists']=$arr; */
		
		$this->_setListsArr(Config::get());
        
        return json_encode($this->data);
    }

    public function env()
    {
        //读取所有的环境变量
        /* $arr=fn_com_ksort_arr(Env::get());
		$this->data['lists']=$arr; */
        
		$this->_setListsArr(Env::get());
		
        return json_encode($this->data);
    }

    public function serv()
    {
        //读取所有的服务器参数
        //return dump($_SERVER);
        /* $arr=fn_com_ksort_arr($_SERVER);
		$this->data['lists']=$arr; */
        
		$this->_setListsArr($_SERVER);
        return json_encode($this->data);
    }
}

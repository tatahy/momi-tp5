<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

use app\patent\model\Patinfo as Pat;


class Expert extends Controller
{
    const ENT='expert';
	const SYSENT=['com','gov','edu','dev','ngo','person'];
	
	private $brief=[];
	private $data=[];
	
	private function _setBrief()
	{
		$arr=[];
		$num=0;
		
		foreach(self::SYSENT as $key=>$val){
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
	
	public function com(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'com']);   
		
        return json_encode($result);
    }

    public function gov(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'gov']);   
		
        return json_encode($result);
    }
	
	public function edu(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'edu']);   
		
        return json_encode($result);
    }
	
	public function dev(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'dev']);   
		
        return json_encode($result);
    }
	
	public function ngo(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'ngo']);   
		
        return json_encode($result);
    }
	
	public function person(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'person']);   
		
        return json_encode($result);
    }
	
}

<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;


class Mentor extends Controller
{
    const ENT='mentor';
	const CATEGORY=['material','computer','strategy','finance','operation'];
	const TYPE=[
			'_TYPE1'=>'material',
			'_TYPE2'=>'computer',
			'_TYPE3'=>'strategy',
			'_TYPE4'=>'finance',
			'_TYPE5'=>'operation',
			'_NONE'=>'none',
		];
		
	private $brief=[];
	private $data=[];
	
	private function getTypeDbValue($value='none')
	{
		$key=array_search($value,self::TYPE);
		
		return $key;
	}
	
	private function _setBrief()
	{
		$arr=[];
		$num=0;
		
		foreach(self::CATEGORY as $key=>$val){
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
	
	public function material()
    {
    	$result= array_merge($this->data,['sysEnt'=>'person']);   
		
        return json_encode($result);
    }

    public function computer(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'person']); 
		
        return json_encode($result);
    }
	
	public function strategy(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'person']);
		
        return json_encode($result);
    }
	
	public function finance(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'person']);
		
        return json_encode($result);
    }
	
	public function operation(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'person']);
		
        return json_encode($result);
    }
	
	
	
}

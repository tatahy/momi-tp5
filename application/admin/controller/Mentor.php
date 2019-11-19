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
	private $itemsTotal=[];
		
	private function getTypeDbValue($value='none')
	{
		$key=array_search($value,self::TYPE);
		
		return $key;
	}
	
	private function _setBrief()
	{
		$arr=[
			'name'=>self::CATEGORY,
			'routeStr'=>[],
			'total'=>[]
		];
		
		foreach(self::CATEGORY as $key=>$val){
			$arr['routeStr'][$key]=self::ENT.'-'.$val;
			$arr['total'][$key]=0;
		}
		
		return $arr;
		
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
	
		$this->itemsTotal=array_combine($this->brief['routeStr'],$this->brief['total']);
		
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

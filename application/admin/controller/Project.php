<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

class Project extends Controller
{
    const ENT='project';
	const SYSENT=['com','dev','ngo','person'];
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
			'sysEnt'=>self::SYSENT,
			'routeStr'=>[],
			'total'=>[]
		];
		
		foreach(self::SYSENT as $key=>$val){
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
	
	public function com(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'com']);   
		
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

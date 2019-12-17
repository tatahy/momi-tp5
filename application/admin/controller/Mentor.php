<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

use app\mentor\model\MentorInfo as Men;

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
		];
		
	private $data=[];
	
	private function _getTypeDbValue($value='')
	{
		if(in_array($value,self::TYPE)){
			$key=array_search($value,self::TYPE);
		}else{
			$key='_TYPE1';
		}
		return $key;
	}
	
	private function _setDataItems()
	{
		$arr=[];
		$num=10;
		$type='_';
		
		foreach(self::CATEGORY as $key=>$val){
			$type=$this->_getTypeDbValue($val);
			
			//$num=$type;
			
			/* if($val=='material'){
				$num=Men::getMenNum($type);
			} */
			
			$num=Men::getMenNum($type);
			
			$arr[$key]=[
				'name'=>$val,	
				'routeStr'=>self::ENT.'-'.$val,	
				'total'=>$num,	
			];
		}
		
		return $arr;
		
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
	
	public function material()
    {
    	$type=$this->_getTypeDbValue(self::CATEGORY[0]);
		$result= array_merge($this->data,Men::getMenList($type));   
		
        return json_encode($result);
    }

    public function computer(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'mentor']); 
		
        return json_encode($result);
    }
	
	public function strategy(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'mentor']);
		
        return json_encode($result);
    }
	
	public function finance(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'mentor']);
		
        return json_encode($result);
    }
	
	public function operation(Request $request)
    {
    	$result= array_merge($this->data,['sysEnt'=>'mentor']);
		
        return json_encode($result);
    }
	
	
	
}

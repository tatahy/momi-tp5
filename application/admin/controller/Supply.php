<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

use app\patent\model\Patinfo as Pat;


class Supply extends Controller
{
    const SYSENT=['pat','pro','sol','ach'];
	const ENT='supply';
	const CURD=['create','update','retrieve','delete'];
	
	private $data=[];
	
	private function _setDataItems()
	{
		$arr=[];
		$num=0;
		
		foreach(self::SYSENT as $key=>$val){
			
			if($val=='pat')$num=Pat::getPatNum();
			if($val=='pro')$num=0;
			if($val=='sol')$num=0;
			if($val=='ach')$num=0;
			
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
	
	//pat的CURD
	public function pat(Request $res,$oprt='retrieve')
    {
    	$oprt=in_array($oprt,self::CURD)?$oprt:'retrieve';
		$result=[
			'routeStr'=>self::ENT.'-'.'patent',
			'oprt'=>$oprt,
			'success'=>false,
		];
		
		
				
		if($oprt=='retrieve'){
			$result['success']=true;
			$result=array_merge($result,$this->data,Pat::getPatList());
			
		}
		
		if($oprt=='update'){
			/* $id=$res->post('id');
			$arr=$res->post();
			
			if($id){
				unset($arr['id'])
				
				$success=Pat::where('id',$res->post('id'))->update($res->post('id'));
			
				$result['success']=$success?true:false;
				
			} */
		
		//$result=array_merge(['oprt'=>$oprt],['id'=>$res->param('id')]);
			//$result=$res->post();
			
			//$result=Pat::update($res->post());
			$success=Pat::where('id',$res->post('id'))->update($res->post());
			
			$result['success']=$success?true:false;
			
		}
	
		return json_encode($result);
    }

    public function pro()
    {
    	 
    	$result= array_merge($this->data,['sysEnt'=>'pro',]);   
		
        return json_encode($result);
    }
	
	public function sol()
    {
    	 
    	$result= array_merge($this->data,['sysEnt'=>'sol']);   
		
        return json_encode($result);
    }
	
	public function ach()
    {
    	 
    	$result= array_merge($this->data,['sysEnt'=>'ach']);   
		
        return json_encode($result);
    }
}

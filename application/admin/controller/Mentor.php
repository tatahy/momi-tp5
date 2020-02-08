<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

use app\mentor\model\MentorInfo as Men;

class Mentor extends Controller
{
    const ENT='mentor';
	
	const TYPE=[
			'_TYPE1'=>['material','computer'],
			'_TYPE2'=>['strategy','finance','operation']
		];
	
	const TYPES=['_TYPE1','_TYPE2'];
	const FIELDS=['material','computer','strategy','finance','operation'];	
	const CURD=['create','update','retrieve','delete'];
		
	private $data=[];
	private $reqData=[];
	private $oprt='';
	private $routeStr='';
	private $catIndex='';
	/* 
	private function _getTypeDbValue($value='')
	{
		if(in_array($value,self::TYPE)){
			$key=array_search($value,self::TYPE);
		}else{
			$key='_TYPE1';
		}
		return $key;
	}
	 */
	private function _setDataItems()
	{
		$arr=[];
		$num=10;
		//$type='_';
		
		
		foreach(self::FIELDS as $key=>$val){
			//$type=$this->_getTypeDbValue($val);
		
			$num=Men::getMenNum($val);
			
			$arr[$key]=[
				'name'=>$val,	
				'routeStr'=>self::ENT.'-'.$val,	
				'total'=>$num,	
			];
		}
		
		return $arr;
	}
	
	private function _getOprtResult()
	{
		$field=self::FIELDS[$this->catIndex];
		$routeStr=self::ENT;
		$oprt=in_array($this->oprt,self::CURD)?$this->oprt:'retrieve';
		
		$post=$this->reqData;
		
		$id=array_key_exists('id',$post)?$post['id']:0;
		
		$success=false;
		
		if($oprt=='retrieve'){
			$this->routeStr=$routeStr;
		}
		else{
			$this->routeStr=$routeStr.'-'.$field;
			$routeStr.='-'.$post['field'];
		}
		
		$result=[
			'cat'=>$field,
			'routeStrOri'=>$this->routeStr,
			'routeStr'=>$routeStr,
			'oprt'=>$oprt,
			'success'=>false
		];
		
		
		if(array_key_exists('id',$post)){
			unset($post['id']);
		}
		
		//模型对象实例
		$mentor = new Men;
		
		if($oprt=='retrieve'){
			//$result= array_merge($result,$this->data,Men::getMenList($field));   
			$result= array_merge($result,$this->data,$mentor->getMenList($field));   
			
		}
		
		if($oprt=='update'){
			
			//模型的静态update方法更新，返回模型的对象实例
			//$success=Men::update($post);
			//模型的静态方法调用数据库方法update()返回的是受影响的记录数
			//$success=Men::where('id',$id)->update($post);
			
			//模型对象调用数据库方法update()返回的是受影响的记录数
			$success=$mentor->where('id',$id)->update($post);
			
			/* //模型对象的save()方法带更新条件来更新数据,若不出错返回的都是true
			$success=$mentor->allowField(true)->save($post,['id' => $id]); */
		}
		
		if($oprt=='create'){
			
			/* 
			//模型的静态方法create()返回模型的对象实例
			$mentor = Men::create($post, true);
			$success=$mentor->id?true:false;
			 */
			//模型对象的save()方法新增返回的是写入的记录数（通常是1），而不是自增主键值。
			$success=$mentor->allowField(true)->save($post);
			
		}
		$result['success']=$success?true:false;	
		$result=array_merge($result,['successValue'=>$success]);
		
		//清除模型对象实例
		$mentor=null;
		
        return $result;
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
	
	public function material(Request $req,$oprt='')
    {
		$this->catIndex=0;
		$this->reqData=$req->post();
		$this->oprt=$oprt;
		
		$result=$this->_getOprtResult();
		
		return json_encode($result);
		
	}
	
    public function computer(Request $req,$oprt='')
    {
    	$this->catIndex=1;
		$this->reqData=$req->post();
		$this->oprt=$oprt;
		
		$result=$this->_getOprtResult();
		
        return json_encode($result);
    }
	
	public function strategy(Request $req,$oprt='')
    {
    	$this->catIndex=2;
		$this->reqData=$req->post();
		$this->oprt=$oprt;
		
		$result=$this->_getOprtResult();
		
        return json_encode($result);
    }
	
	public function finance(Request $req,$oprt='')
    {
    	$this->catIndex=3;
		$this->reqData=$req->post();
		$this->oprt=$oprt;
		
		$result=$this->_getOprtResult();
		
        return json_encode($result);
    }
	
	public function operation(Request $req,$oprt='')
    {
    	$this->catIndex=4;
		$this->reqData=$req->post();
		$this->oprt=$oprt;
		
		$result=$this->_getOprtResult();
		
        return json_encode($result);
    }
	
	
	
}

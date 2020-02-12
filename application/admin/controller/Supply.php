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
	public function pat(Request $req,$oprt='')
    {
    	$oprt=in_array($oprt,self::CURD)?$oprt:'retrieve';
		$result=[
			'routeStr'=>self::ENT.'-'.'pat',
			'oprt'=>$oprt,
			'success'=>false,
		];
		
		$post=$req->post();
		$id=0;
		$success=false;
		
		if(array_key_exists('id',$post)){
			$id=$post['id'];
			unset($post['id']);
		}
		
		//模型对象实例
		$pat=new Pat;
				
		if($oprt=='retrieve'){
			$success=true;
			$result=array_merge($result,$this->data,$pat->getPatList());
			
		}
		
		if($oprt=='update'){
			//模型的静态update方法更新，返回模型的对象实例
			//$success=Men::update($post);
			//模型的静态方法调用数据库方法update()返回的是受影响的记录数
			//$success=Pat::where('id',$post('id'))->update($post);
			
			//模型对象调用数据库方法update()返回的是受影响的记录数
			$success=$pat->where('id',$id)->update($post);
			
		}
		
		if($oprt=='create'){
			
			/* 
			//模型的静态方法create()返回模型的对象实例
			$mentor = Men::create($post, true);
			$success=$mentor->id?true:false;
			 */
			//模型对象的save()方法新增返回的是写入的记录数（通常是1），而不是自增主键值。
			$success=$pat->allowField(true)->save($post);
			
		}
		
		$result['success']=$success?true:false;	
		//清除模型对象实例
		$pat=null;
		
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

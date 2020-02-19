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
		
		$id=0;
		
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
			$id=$post['id'];
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
		
		//$result=array_merge($result,['successValue'=>$success]);
		
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
	
	public function uploadPicture(Request $req,$id=0)
	{
		//‘.’表示与入口文件在同一级目录
		$dir='./uploads/pictures/mentor/';
		//‘..’表示与在入口文件的上一级目录
		//$dir='../uploads/pictures/mentor/';
		$resInfo=[
			'success'=>false,
			'ext'=>'',
			'dir'=>'',
			'name'=>'',
			'error'=>''
		];
		$file ='';
		$info ='';
		
		$flag=false;
		//模型对象实例
		$mentor = new Men;
		
		if($id){
			// 获取表单上传文件
			$file = $req->file('fileObj');
					
			$info = $file
					//有效性验证，size规定允许的最大字节数256KB=262144B
					//ext规定后缀名，//不通过就返回false
					->validate(['size'=>262144,'ext'=>'jpg,png,gif,jpeg'])
					//使用uniqid规则创建文件名
					//->rule('uniqid')
					//移动到服务器的上传目录
					//->move($dir);
					// 移动到服务器的上传目录 并且使用原文件名
					->move($dir,'');
		}
		
		if($info){
			$flag=true;
			//去掉$dir中的‘.’或‘..’
			$dir=strstr($dir,'/');
			$resInfo['dir']=$dir;
			//得到后缀名
			$resInfo['ext']=strtolower($info->getExtension());
			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			//$info->getSaveName();
			//得到上传目录里的完整文件名
			$resInfo['name']=$info->getFilename(); 
			
		}else{
			// 上传失败获取错误信息
			$resInfo['error']=$file->getError();
		}
		
		//写入数据库，文件所在目录及文件名
		if($flag){
			
			$flag=$mentor->uploadPicture($id,['dir'=>$dir,'name'=>$resInfo['name']]);
		}
			
		$resInfo['success']=$flag?true:false;
		
		//释放对象实例
		$mentor = null;
		
		return json_encode($resInfo);
	}
	
}

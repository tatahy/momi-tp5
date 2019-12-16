<?php

/**
 * @author TATA
 * @copyright 2019
 */

namespace app\mentor\model;

use think\Model;

class MentorInfo extends Model
{
    
	
	//直接使用本模块中的数据库配置参数名
    protected $connection = 'db_mentor';
	
	const TYPE=['_TYPE1','_TYPE2','_TYPE3','_TYPE4','_TYPE5'];

    //本类的静态方法中用于访问非静态方法时实例化本类对象
    static private $obj = null;
	
	static public function getMenNum($type='')
	{
		$typeArr=['_TYPE1','_TYPE2','_TYPE3','_TYPE4','_TYPE5'];
		$num = $type;
		
		self::$obj = new self();
		
		if(in_array($type,self::TYPE)){
			$num = self::$obj->where('type',$type)->count();
			//$num = self::$obj->count();
		}else{
			$num = self::$obj->count();
		}
		//$num = in_array($type,$typeArr);
		self::$obj = null;
		
		return $num;
	}

    static public function getMenList($type='')
    {
       
		$res = [
			'sysEnt'=>'mentor',
			'fields'=>['id','name', 'type', 'title', 'position', 'field', 'research','profile', 'experience'],
			'lists'=>[]
		];
		
		$type=in_array($type,self::TYPE)?$type:'';
		
        self::$obj = new self();

        //$res=self::$obj->all();
        //$res=self::$obj->all()->visible(['patnum','topic','type']);
        
        //$res = self::$obj->field(['patnum'=>'专利编号', 'topic' => '标题', 'type' => '类型', 'patowner' =>
//            '所有人', 'inventor' => '发明人', 'author' => '作者'])->order('patnum', 'asc')->select();


//            '专利编号'=='\x4E13\x5229\x7F16\x53F7'
        //$res = self::$obj->field(['patnum'=>'bb', 'topic', 'type', 'patowner', 'inventor', 'author'])->order('patnum', 'asc')->select();
            
        $res['lists'] = self::$obj
				->field($res['fields'])
				->where('type',$type)
				->order('name', 'asc')
				->select();
        //获取数据表的全部字段
        //$res=self::$obj->field(true)->order('patnum','asc')->select();
        self::$obj = null;

        return $res;
    }
}

?>
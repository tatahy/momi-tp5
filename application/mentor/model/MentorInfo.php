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
	
	//开启自动写入创建和更新的时间戳字段
	//自动写入create_time和update_time两个字段的值，默认为整型（int）
	//时间字段的自动写入仅针对模型的写入方法，如果使用数据库的更新或者写入方法则无效。
	protected $autoWriteTimestamp = true;
	
	const TYPES=['_TYPE1','_TYPE2','_TYPE3','_TYPE4','_TYPE5'];
	const FIELDS=['material','computer','strategy','finance','operation'];

    //本类的静态方法中用于访问非静态方法时实例化本类对象
    static private $obj = null;
	
	static public function getMenNum($field='')
	{
		$num = $field;
		
		self::$obj = new self();
		
		if(in_array($field,self::FIELDS)){
			$num = self::$obj->where('field',$field)->count();
			//$num = self::$obj->count();
		}else{
			$num = self::$obj->count();
		}
		//$num = in_array($type,$typeArr);
		self::$obj = null;
		
		return $num;
	}

    static public function getMenList($field='')
    {
       
		$res = [
			'sysEnt'=>'mentor',
			//返回前端的字段
			'fields'=>['id','name', 'type', 'title', 'position', 'field', 'research','profile', 'experience'],
			'lists'=>[]
		];
		
		$field=in_array($field,self::FIELDS)?$field:'';
		
        self::$obj = new self();

        $res['lists'] = self::$obj
				->field($res['fields'])
				->where('field',$field)
				->order('name', 'asc')
				->select();
        
		/* //获取数据表的全部字段
        $res=self::$obj->field(true)->order('patnum','asc')->select(); */
		
		
        self::$obj = null;

        return $res;
    }
}

?>
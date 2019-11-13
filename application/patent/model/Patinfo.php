<?php

/**
 * @author TATA
 * @copyright 2019
 */

namespace app\patent\model;

use think\Model;

class Patinfo extends Model
{
    //直接使用本模块中的数据库配置参数名
    protected $connection = 'db_remote';

    //本类的静态方法中用于访问非静态方法时实例化本类对象
    static private $obj = null;
	
	static public function getPatNum()
	{
		self::$obj = new self();
		$num = self::$obj->count();
		self::$obj = null;
		return $num;
	}

    static public function getPatList()
    {
        $showFields=['patnum', 'topic', 'type', 'patowner', 'inventor', 'author'];
		$list = [
			'sysEnt'=>'pat',
			'fields'=>['id','patnum', 'topic', 'type', 'patowner', 'inventor', 'author'],
			'items'=>[]
		];
        self::$obj = new self();

        //$list=self::$obj->all();
        //$list=self::$obj->all()->visible(['patnum','topic','type']);
        
        //$list = self::$obj->field(['patnum'=>'专利编号', 'topic' => '标题', 'type' => '类型', 'patowner' =>
//            '所有人', 'inventor' => '发明人', 'author' => '作者'])->order('patnum', 'asc')->select();


//            '专利编号'=='\x4E13\x5229\x7F16\x53F7'
        //$list = self::$obj->field(['patnum'=>'bb', 'topic', 'type', 'patowner', 'inventor', 'author'])->order('patnum', 'asc')->select();
            
        $list['items'] = self::$obj
				->field($list['fields'])
				->order('patnum', 'asc')
				->select();
        //获取数据表的全部字段
        //$list=self::$obj->field(true)->order('patnum','asc')->select();
        self::$obj = null;
		
		$list['fields'] = $showFields;

        return $list;
    }
}

?>
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
	
	protected $insert = ['patnum'];
	//只读字段，这个字段的值一旦写入，就无法更改。
    protected $readonly = ['patnum'];
	//时间字段的自动写入仅针对模型的写入方法，如果使用数据库的更新或者写入方法则无效。
	protected $autoWriteTimestamp = true;

    //本类的静态方法中用于访问非静态方法时实例化本类对象
    static private $obj = null;
	
	//设置patnum字段的值为pat+yyyy+0000的形式，即是在当年进行流水编号
    protected function setPatnumAttr()
    {

        $idmax = Patinfo::max('id');
        $value = Patinfo::where('id', $idmax)->value('patnum');

        $year = substr($value, 3, 4);
        $num = substr($value, 3) + 1;

        if ($year == date('Y')) {
            $result = "pat".$num;
        } else {
            $result = "pat".date('Y')."0001";
        }

        return ($result);
    }
	
	//修改器，修改存入数据表patinfo中status字段值，转换为类型编码。
    protected function setStatusAttr($key)
    {
      
        return '*';
    }
	
	static public function getPatNum()
	{
		self::$obj = new self();
		$num = self::$obj->count();
		self::$obj = null;
		return $num;
	}

    static public function getPatList()
    {
        
		$res = [
			'sysEnt'=>'pat',
			'fields'=>['id','patnum', 'topic', 'type', 'patowner', 'inventor', 'author'],
			'lists'=>[]
		];
        self::$obj = new self();

        //$res=self::$obj->all();
        //$res=self::$obj->all()->visible(['patnum','topic','type']);
        
        //$res = self::$obj->field(['patnum'=>'专利编号', 'topic' => '标题', 'type' => '类型', 'patowner' =>
//            '所有人', 'inventor' => '发明人', 'author' => '作者'])->order('patnum', 'asc')->select();


//            '专利编号'=='\x4E13\x5229\x7F16\x53F7'
        //$res = self::$obj->field(['patnum'=>'bb', 'topic', 'type', 'patowner', 'inventor', 'author'])->order('patnum', 'asc')->select();
            
        $res['lists'] = self::$obj
				->field($res['fields'])
				->order('patnum', 'asc')
				->select();
        //获取数据表的全部字段
        //$res=self::$obj->field(true)->order('patnum','asc')->select();
        self::$obj = null;

        return $res;
    }
}

?>
<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Request;

use app\patent\model\Patinfo as Pat;


class Supply extends Controller
{
    private $data=['ent' => 'supply','fields'=>[],'items'=>[]];
	/* private $itemsTotal=[
				['name'=>'sys-conf','value'=>0],
				['name'=>'sys-env','value'=>0],
				['name'=>'sys-serv','value'=>0],
			]; */
	private $itemsTotal=[
				'supply-pat'=>0,
				'supply-pro'=>0,
				'supply-sol'=>0,
				'supply-ach'=>0,
			];
	
	public function __construct()
	{
		$arr=$this->itemsTotal;
		
		$arr['supply-pat']=Pat::getPatNum();
		$arr['supply-pro']=2;
		$arr['supply-sol']=3;
		$arr['supply-ach']=4;
		$this->itemsTotal=$arr;
		
		return $this->itemsTotal;
		
	}
	
	public function index()
    {
  		$arr=$this->itemsTotal;
		
		//$arr['supply-pat']=count(Pat::getPatList());
		
    	return json_encode(array_merge(['itemsTotal'=>$this->itemsTotal],$this->data));

	}
	
	public function pat()
    {
    	 
    	$result= array_merge($this->data,Pat::getPatList());   
		
        return json_encode($result);
    }

    
}

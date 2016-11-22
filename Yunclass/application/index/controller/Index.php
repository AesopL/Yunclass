<?php
namespace app\index\controller;
use think\controller;
use app\index\model\Teacher;

class Index extends controller{
	
	//构造函数进行验证登录
	public function __construct() {
		// 调用父类构造函数(必须)
		parent::__construct();

		// 验证用户是否登陆
		if (!Teacher::islogin()) {
			return $this -> error('请重新登录',url('login/index'));
		}
	}
	
	public function index(){
		
	}

}

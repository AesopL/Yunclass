<?php
namespace app\index\controller;
use think\controller;
use app\index\model\Teacher;
use think\Input;
use Captcha;
use think\request;

class Login extends controller {
	public function index() {
		return $this -> fetch();
	}

	//登录验证
	public function login() {
		//检查提交内容是否为空
		if (Request::instance() -> isPost()) {
			//获取数据
			$username = input("request.username");
			$password = input("request.psw");
			//var_dump($password);
			if (Teacher::logining($username, $password)) {
				return true;
			}
		}

		return false;

	}

	//动态验证验证码
	public function valicap() {
		$data = input('request.captcha');
		if (!captcha_check($data)) {
			//验证码错误
			return false;
		} else {
			return true;
		}
	}

	public function testpass() {
		$pass = '123456';
		echo Teacher::encryptPassword($pass);
	}
	
	public function logout(){
		if(Teacher::logouting()){
			return $this->success("退出成功",url('login/index'));
		}else{
			return $this->error("服务器炸了",url('login/index'));
		}
	}

}
?>
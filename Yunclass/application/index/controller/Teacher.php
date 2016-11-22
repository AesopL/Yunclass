<?php
namespace app\index\controller;
use think\controller;
use think\request;

class Teacher extends Index {
	public function index() {
		//判断是否存在登录
//      if (!Teacher::islogin())
//      {
//          return $this->error('请重新登录', url('Login/index'));
//      }

		$teachers = \app\index\model\Teacher::show();
		$this -> assign('list', $teachers);
		return $this -> fetch();
	}

	public function add() {
		return $this -> fetch();
	}

	public function add_post() {

		if (Request::instance() -> isPost()) {
			$name = input('name');
			$username = input('username');
			$sex = input('sex');
			$email = input('email');

			$insert = \app\index\model\Teacher::add($name, $username, $sex, $email);
			if ($insert) {
				//return $this -> success('添加成功', 'index');
				return true;
			} else {
				//return $this -> error('添加失败');
				return false;
			}
		}
	}

	public function deleterow($id) {
		//var_dump($id);
		if (0 === $id) {
			throw new \Exception("未获取到ID信息", 1);
		}
		$row = \app\index\model\Teacher::dele($id);
		//var_dump($row);

		if (!$row) {
			return '删除失败';
		} else {
			return '删除成功';
		}
	}

	public function editrow($id) {
		$res = \app\index\model\Teacher::edit($id);
		$this -> assign('Teacher', $res);
		return $this -> fetch();
	}

	public function edit_post($id) {
		//var_dump(Request::instance()->isPost());
		//var_dump($id);
		//var_dump(Request::instance() -> post());
		//var_dump($_POST);
		$teach = Request::instance() -> post();

		$res = \app\index\model\Teacher::edit_post($id, $teach);
		if ($res) {
			return true;
		}
		return false;
	}

	public function opensearch() {

		try {
			// 获取查询信息
			$name = Request::instance() -> Post('name');
			//var_dump($name);

			// 每页显示5条数据
			$pageSize = 5;

			// 实例化Teacher
			$Teacher = new \app\index\model\Teacher;

			// 定制查询信息
			if (!empty($name)) {
				$teachers = \app\index\model\Teacher::search($name);
				//var_dump($teachers);
				// 向V层传数据
				$this -> assign('teachers', $teachers);

				// 取回打包后的数据
				return $this -> fetch();
			} else {
				return $this -> error('不能空');
			}

			// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
		} catch (\think\Exception\HttpResponseException $e) {
			throw $e;

			// 获取到正常的异常时，输出异常
		} catch (\Exception $e) {
			return $e -> getMessage();
		}

	}

	//查询
	public function search() {
		return $this -> fetch("opensearch");
	}

	public function searchlist() {
		$name = Request::instance() -> Post('name');
		if (!$name) {
			return false;
		}
		$teachers = \app\index\model\Teacher::search($name);
		//var_dump($teachers);
		return json($teachers);
	}

}
?>
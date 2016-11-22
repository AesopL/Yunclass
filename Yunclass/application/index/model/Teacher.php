<?php

namespace app\index\model;
use think\model;
use think\db;
use think\Validate;

class Teacher extends \think\model{
	public static function show(){
		$teacher= Teacher::where([])->paginate(5);
		return $teacher;
	}
	
	public static function add($name,$username,$sex,$email){
		$data['name']=$name;
		$data['username']=$username;
		$data['sex']=$sex;
		$data['email']=$email;
		
		$validate = new Validate([
			'username' => 'require|unique:teacher|length:4,25',
			'name'  => 'require|length:2,25',
			'sex' => 'in:0,1',
			'email' => 'email',
			]);
		
		if (!$validate->check($data)) {
			dump($validate->getError());
		}else{
			$isinsert = Teacher::create($data);
			if($isinsert){
				return true;
			}else{
				return false;
			}
		}
	}
	
	public static function dele($id){
		$res = Teacher::get($id);
		if(!is_null($res)){
			if(Teacher::where(["id"=>$id])->delete()){
				return true;
			}
		}
		return false;
	}
	
	public static function edit($id){
		$res = Teacher::get($id);
		 if (null === $res )
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 
		//$res = Teacher::get($id);
		return $res;
	}
	
	public static function edit_post($id,$data){
		//$data['id']=$id;
		$validate = new Validate( [
			'name'  => 'require|length:2,25',
			'username' => 'require|length:4,25',
			'sex' => 'in:0,1',
			'email' => 'email',
			]);
		
		if (!$validate->check($data)) {
			dump($validate->getError());
		}else{
			$info = Teacher::where(["id"=>$id])->update($data);
			if($info){
				return true;
			}else{
				//return $this->error($this->gerError());
				return false;
			}
		}
	}
	
	//查询name为$name的数据
	public static function search($name){
		$res = Teacher::where('name', 'like', '%' . $name . '%')->select();
		return $res;
		
	}
	
	
}

?>
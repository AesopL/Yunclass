<?php
namespace app\index\controller;
use think\db;

class Index
{
    public function index()
    {
       //var_dump(Db::name('teacher')->find());
       //获取表中所有元素
	   $teacher=Db::name('teacher')->select();
	   var_dump($teacher);
      }
}

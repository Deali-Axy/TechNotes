<?php

class User
{
	public $id;
	public $name;
	public $regtime;
	
	private $db;
	
	//通过传入用户id给构造函数就可以获取其他属性
	function __construct($id)
	{
		$db=\Core\Database::getInstance();
		$res=$db->query("select * from user where id='{$id}'");
		$data=$res->fetch_assoc();
		
		$this->id=$id;
		$this->name=$data['name'];
		$this->regtime=$data['regtime'];
	}
	
	//通过析构函数来保存属性到数据库中
	function __deconstruct()
	{
		$this->db->query("update user set name='{$this->name}' regtime='{$this->regtime}' where id='{$this->id}' limit 1");
	}
}
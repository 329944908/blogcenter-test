<?php
	class UserModel{
		public $mysqli;
		function __construct(){
			$this ->mysqli = new mysqli("localhost","root","","stu");
			$this->mysqli->query('set names utf8');
		}
		function addUser($name,$age,$password,$image){
			$sql = "insert into user(name,age,password,image) value('{$name}',{$age},'{$password}','{$image}')";
			$res = $this ->mysqli ->query($sql);
			return $res;
		}
		function deleteUser($id){
			$sql = "delete * from user where id = {$id}";
			$res = $this ->mysqli ->query($sql);
			return $res;
		}
		function updateUser($id,$name,$age,$password){
			$sql = "update user set name = '{$name}',age = {$age},password={$password} where id = {$id}";
			$res = $this ->mysqli ->query($sql);
			return $res;
		}
		function getUserLists(){
			$sql = "select * from user";
			$res = $this ->mysqli ->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		public function getUserInfoById($id){
			$sql = "select * from user where id= {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0])?$data[0]: 0;
		}
		function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0])?$data[0]: 0;
		}
	}
<?php	
	class BlogModel{
		public $mysqli;
		function __construct(){
			$this->mysqli = new mysqli("localhost","root","","stu");
			$this->mysqli->query('set names utf8');
		}
		function addBlog($content,$user_id){
			$sql = "insert into blog (content,user_id) value('{$content}',{$user_id});";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getBlogCount(){
			$sql = "select count(*) as num from blog;";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0]['num'];
		}
		function getBlogLists($offset,$pageSize){
			$sql = "select * from blog limit {$offset},{$pageSize}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		function getContentInfo($id){
			$sql = "select * from blog where id = {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
	}
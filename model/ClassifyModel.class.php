<?php
	class ClassifyModel {
		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","stu");
			$this->mysqli->query('set names utf8');
		}
		function getLists() {
			$sql = "select * from classify where pid = 0";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			foreach ($data as $key => $value) {
				$sqlChild = "select * from classify where pid = {$value['id']}";
				$resChild = $this->mysqli->query($sqlChild);
				$child = $resChild->fetch_all(MYSQL_ASSOC);
				$data[$key]['child'] = $child;
			}
			return $data;
		}
	}
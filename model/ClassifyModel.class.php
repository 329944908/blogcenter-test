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
		public  function getListsName($classify_id) {
			isset($classify_id) ? $classify_id : 7;
			if ($classify_id !='请选择') {
				$sql = "select * from classify where id = {$classify_id}";
				$res = $this->mysqli->query($sql);
				$data = $res->fetch_all(MYSQL_ASSOC);
				return isset($data[0])?$data[0]: 0;
				
			}
		}
	}
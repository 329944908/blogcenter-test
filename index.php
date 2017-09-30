<?php
	header("content_type:txt/html;charset=utf-8");
	$controller = isset($_GET['c']) ? $_GET['c'] : 'Blog';
	$action     = isset($_GET['a']) ? $_GET['a'] : 'blogLists';
	session_start();
	function __autoload($class){
		if(strpos($class, "Controller") !== false){
			$dir = 'controller';
		}elseif (strpos($class, "Model") !== false) {
			$dir = 'model';
		}else{
			die($class."不存在");
		}
		include "./{$dir}/{$class}.class.php";
	}
	$className = "{$controller}Controller";
	$con = new $className();
	$con ->$action();
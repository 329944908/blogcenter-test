<?php
	header("content_type:txt/html;charset=utf-8");
	$controller = isset($_GET['c']) ? $_GET['c'] : 'Blog';
	$action     = isset($_GET['a']) ? $_GET['a'] : 'blogLists';
	session_start();
	include "./common/function.php";
	$className = "{$controller}Controller";
	$con = new $className();
	$con ->$action();
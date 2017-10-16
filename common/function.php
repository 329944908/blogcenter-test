<?php
	function L($name){
		include "./library/{$name}.class.php";
			$lib = new $name();
			return $lib; 
	}
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
	function getRandom($len){
		$str = '0123456789asdfghjklzx';
		$max = strlen($str);
		$res = '';
		for ($i=0;$i<$len;$i++) { 
			$res.=$str[mt_rand(0,$max-1)];
		}
		return $res;
	}
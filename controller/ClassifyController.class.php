<?php
	class ClassifyController {
		public function __construct() {
		}
		public function add () {
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getLists();
			include "./view/classify/add.html";
		}
		public function doAdd() {
			$className = $_POST['className'];
			$pid  = $_POST['pid'];
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->addClassify($className,$pid);
			header('Location:index.php?c=Blog&a=add');
		}
	}
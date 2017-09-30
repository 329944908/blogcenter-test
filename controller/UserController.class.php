<?php
	class userController{
		function updateUserInfo(){
			$id = $_GET['id'];
	        $usermodel = new UserModel();
	        $info = $usermodel->getUserInfoById($id);
			include "./view/user/edit.html";
		}
		function doUpdate(){
			$id = $_POST['id'];
			$name = $_POST['name'];
			$age = $_POST['age'];
			$password = $_POST['password'];
			$usermodel = new UserModel();
			$res = $usermodel->updateUser($id,$name,$age,$password);
			$info = $usermodel->getUserInfoById($id);
			$_SESSION['me'] = $info;
			header('Refresh:3,Url=index.php?c=Blog&a=blogLists');
			echo "修改成功，3秒后跳转";
		}
	}
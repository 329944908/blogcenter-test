<?php
	class UserCenterController{
		function login(){
			include "./view/user/login.html";
		}
		function doLogin(){
			$name = $_POST['name'];
			$password = $_POST['password'];
			$verifyCode = $_POST['verifyCode'];
			$usermodel = new  UserModel();
			$info = $usermodel ->getUserInfoByName($name);
			if($info){
				if($info['password']==$password){
					if ($_SESSION['verifyCode'] == $verifyCode) {
					$_SESSION['me'] = $info;
					header('Refresh:3,Url=index.php?c=Blog&a=blogLists');
					echo "登陆成功";
					}else{
						header('Refresh:3,Url=index.php?c=UserCenter&a=login');
						echo "验证码错";
					}
				}else{
					echo "密码错误";
				}
			}else{
				echo "用户名不存在";
			}
		}
		function reg(){
			include "./view/user/reg.html";
		}
		function doReg(){
			include "./library/Upload.class.php";
			$upload = new Upload();
			$image = $upload->run('image');
			$name = $_POST['name'];
			$age = $_POST['age'];
			$password = $_POST['password'];
			$usermodel = new  UserModel();
			$status = $usermodel->getUserInfoByName($name);
			if($status){
				echo "用户名已存在";
			}else{
				$res = $usermodel->addUser($name,$age,$password,$image);
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				echo '注册成功';
			}	
		}
		function logout(){
			unset($_SESSION['me']);
			header('Refresh:3,Url=index.php?c=Blog&a=blogLists');
			echo '退出登录';
			die();
		}
		function userInfo(){
			$id = $_GET['id'];
			$usermodel = new  UserModel();
			$info = $usermodel->getUserInfoById($id);
			include "./view/user/userInfo.html";
			
		}
		public function verifyCode(){
			header("Content-Type:image/png");
			$img = imagecreate(50, 25);
			$back = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
			$red = imagecolorallocate($img, 255, 0, 0);
			$str = getRandom(4) ;
			$_SESSION['verifyCode'] = $str;
			imagestring($img, 5, 7, 5, $str, $red);
			imagepng($img);
			imagedestroy($img);
		}
}
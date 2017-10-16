<?php
	class BlogController{
		function add(){
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getLists();
			include "./view/blog/addContent.html";
		}
		function doAdd(){
			$upload =L("Upload");
			$image = $upload->run('image');
			$content = $_POST['content'];
			$user_id = $_SESSION['me']['id'];
			$classify = $_POST['classify'];
			$title = $_POST['title'];
			$data = array(
				'user_id' 	=> $user_id,
				'content' 	=> $content,
				'classify' 	=> $classify,
				'title' 	=> $title,
				'image' 	=> $image,
				);
			$blogModel = new BlogModel();
			$status = $blogModel->addBlog($data);
			if ($status) {
				header('Refresh:3,Url=index.php?c=Blog&a=blogLists');
				echo "发布成功，3秒后跳转";
			}	
		}
		function blogLists(){
			$blogmodel = new BlogModel();
			$usermodel = new UserModel();
			$p = isset($_GET['p'])?$_GET['p']:1;
			$pageSize = 4;
			$offset = ($p - 1) * $pageSize;
			$count = $blogmodel->getBlogCount();
			$allPage = ceil($count/$pageSize);
			$data = $blogmodel->getBlogLists($offset,$pageSize);
			foreach ($data as $key => $value){
				$user_info = $usermodel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];
		    }
			include "./view/blog/lists.html";
		}
		function getContentInfo(){
			$id = $_GET['id'];
			$blogmodel = new BlogModel();
			$info = $blogmodel-> getContentInfo($id);
			include "./view/blog/contentInfo.html";
		}
	}
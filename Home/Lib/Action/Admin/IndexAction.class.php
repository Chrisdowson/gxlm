<?php
 class IndexAction extends Action{
	public function index(){
		$this->display("login");
	}
	public function loginprocess(){
		$username=$_POST["username"];
		$pwd=$_POST["password"];
		$admin=new Model("admin");
		$res=$admin->where("username='$username'")->find();
		if(md5($pwd)==$res[pwd]){
			$_SESSION['name']=$username;
		header("location:main?name=$username");
		}else 
			$this->error('密码错误！');
	}
	public function main(){
		if(!empty($_SESSION['name'])){
			$this->assign('username',$_REQUEST['username']);
			$jwsys=new Model("jwsys");
			$res=$jwsys->select();
			$this->assign("res",$res);
			$this->display('main');
		}else{
			$this->redirect('index');
		}		
	}
}
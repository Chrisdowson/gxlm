<?php
class TestAction extends Action{
	public function index(){
<<<<<<< HEAD
		$this->display();
	}
=======
        $school = M('school');
        $items = $school->select();
        $this->assign('items', $items);
		$this->display();
	}
    public function test(){
        $controller = I('post.controller');
        $action = I('post.action','login');
        $scount = I('post.scount');
        $password = I('post.password');
        $schoolnum = I('post.schoolnum');
        $controller = new $controller.'Controller'.(array('scount'=>$scount, 'pwd'=>$password, 'schoolno'=>$schoolnum));
        $controller->$action();
        var_dump($controller->res);
    }
>>>>>>> parent of 1aa6ee5... 修改readme文件
}
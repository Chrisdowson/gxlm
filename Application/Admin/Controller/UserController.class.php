<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\CommonController;
class UserController extends CommonController{
    public function index(){
        $Users = D('Users');
        $lists = $Users->select();
        $this->assign('lists',$lists);
        $this->display();
    }
    public function feedback(){
        $Feedback = D('feedback');
        $lists = $Feedback->select();
        $this->assign('lists', $lists);
        $this->display();
    }
}
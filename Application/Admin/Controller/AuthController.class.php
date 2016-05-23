<?php
namespace Admin\Controller;
use Think\Controller;
use Org\My\Tool;
class AuthController extends Controller{
    public function login(){
        if(IS_POST){
            $email = I('post.email');
            $password = I('post.password');
            $Admin = D('Admin');
            $where['email'] = $email;
            $info = $Admin->where($where)->find();
            if(empty($info)){
                Tool::json(array('success'=>0,"msg"=>"用户不存在！"));
            }else{
                if($info['password']==MD5($password)){
                    session('uid',$info['id']);
                    cookie('username',$info['username']);
                    cookie('uid',$info['id']);
                    $this->redirect('index/index');
                }else{
                    Tool::json(array('success'=>0,'msg'=>'账户或密码错误！'));
                }
            }
        }else{
            layout('layout/normal');
            $this->display();
        }
    }
    public function logout(){
        session('uid',null);
        cookie('username',null);
        cookie('uid',null);
        $this->redirect('index/index');
    }
}
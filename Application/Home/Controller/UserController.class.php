<?php
namespace Home\Controller;
use Home\Common\CommonController;
class UserController extends CommonController{
    /**
     * @description 登陆
     * @param string $username
     * @param string $password
     * @return json $res
     */
    public  function login(){
        if(IS_POST){
            $username = I('post.username');
            $password = I('post.password');
            $Users = D('Users');
            $where['username'] = $username;
            $where['password'] = md5($password);
            $userinfo = $Users->where($where)->find();
            if(!empty($userinfo)){
                session('uid',$userinfo['id']);
                cookie('username',$userinfo['username']);
                cookie('uid',$userinfo['id']);
                \Org\My\Tool::json(array('success'=>1,'msg'=>''));
            }else{
                \Org\My\Tool::json(array('success'=>0,'msg'=>'账号或密码错误！'));
            }
        }else{
            $this->redirect('index/index');
        }
    }

    /**
     * @description 注册
     * @param string $username
     * @param string $password
     * @param string $repassword
     * @return json $res
     */
    public function register(){
        if(IS_POST){
            $username = I('post.username');
            $password = I('post.password');
            $repassword = I('post.repassword');
            $users = D('users');
            $userinfo = $users->where("username='".$username."'")->find();
            if(!empty($userinfo)){
                \Org\My\Tool::json(array('success'=>0,'msg'=>'用户名已存在'));
                exit;
            }
            if($password!=$repassword){
                \Org\My\Tool::json(array('success'=>0,'msg'=>'两次输入密码不一致！'));
                exit;
            }
            $data['username'] = $username;
            $data['password'] = $password;
            $data['ctime'] = date('Y-m-d H:i:s',time());
            $res = $users->add($data);
            if(!$res){
                \Org\My\Tool::json(array('success'=>0,'msg'=>'注册失败，请稍后再试！'));
            }else{
                $userinfo = $users->where("username='".$username."'")->find();
                session('uid',$userinfo['id']);
                cookie('username',$userinfo['username']);
                cookie('uid',$userinfo['id']);
                \Org\My\Tool::json(array('success'=>1,'msg'=>'注册成功！'));
            }
        }else{

        }
    }

    /**
     * @description 个人中心
     */
    public function center(){
        if(session('uid')){
            if(IS_POST){

            }else{
                $user = D('users');
                $info = $user->where('id='.session('uid'))->find();
                layout('Layout/center');
                $this->assign('title', '个人中心');
                $this->assign('info', $info);
                $this->display();
            }
        }else{
            $this->redirect('index/index');
        }
    }

    /**
     * @description 登出
     *
     */
    public function logout(){
        session('uid',null);
        cookie('uid',null);
        cookie('username',null);
        $this->redirect('index/index');
    }
    public function upload_avatar(){
        $maxSize = 3145728;
        $exts = array('jpg', 'gif', 'png', 'jpeg');
        $res = $this->uploadfile($maxSize, $exts);
        if($res['success']){
            $where['id'] = cookie('uid');
            $user = D('users');
            $data['avatar'] = $res['path'];
            $result = $user->where($where)->save($data);
            if(!$result){
                $res['success'] = 0;
                $res['msg'] = $user->getDbError();
            }
            $res['path'] = $_SERVER['host'].'/public/upload/avatar/'.$res['path'];
        }
        \Org\My\Tool::json($res);
    }

    /**
     * @description 用户反馈
     * @param string $content
     * @return json $res
     */
    public function feedback(){
        $data['content'] = I('post.content');
        $data['username'] = cookie('username')?cookie('username'):'匿名用户';
        $data['ctime'] = date('Y-m-d H:i:s',time());
        $FeedBack = D('FeedBack');
        $res = $FeedBack->add($data);
        if($res){
            \Org\My\Tool::json(array('success'=>1, 'msg'=>''));
        }else{
            \Org\My\Tool::json(array('success'=>0, 'msg'=>$FeedBack->getError()));
        }

    }

    /**
     * @decription 重置密码
     * @param string $password
     * @param string $repassword
     * @return json $res;
     */
    public function repwd(){
    if(session('uid')){
            if(IS_POST){
                $where['id'] = cookie('uid');
                $password = I('post.password');
                $data['repassword'] = I('post.repassword');
                $User = D('User');
                $res = $User->where($where)->find();
                if(md5($res['password']!=$password)){
                    \Org\My\Tool::json(array('success'=>0,'msg'=>0));
                    exit;
                }
                $res = $User->where($where)->save($data);
                if($res){
                    \Org\My\Tool::json(array('success'=>1, 'msg'=>''));
                }else{
                    \Org\My\Tool::json(array('success'=>0, 'msg'=>$User->getError()));
                }
            }else{
                layout('layout/center');
                $this->display();
            }
        }else{
            $this->redirect('index/index');
        }
    }

    /**
     * @description 测试记录
     * @param int $id
     * @return array $lists
     */
    public function testlog($pagenow = 1){
        if(session('uid')){
            $SolvePro = D('SolvePro');
            $where['uid'] = session('uid');
            $limit = 15;
            $count = $SolvePro->where($where)->count();
            $pagecount =ceil($count/$limit);
            $lists = $SolvePro->where($where)->limit($limit*($pagenow-1).','.$limit)->select();
//            var_dump($pagecount);exit;
            layout('layout/center');
            $this->assign('pagenow', $pagenow);
            $this->assign('pagecount', $pagecount);
            $this->assign('lists', $lists);
            $this->display();
        }else{
            $this->redirect('index/index');
        }
    }
}
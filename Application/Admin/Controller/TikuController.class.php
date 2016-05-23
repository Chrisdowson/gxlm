<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\CommonController;
class TikuController extends CommonController{
    public function add(){
        if(IS_POST){
            $Tiku = D('Tiku');
            $Tiku->create();
            $Tiku->options = json_encode(I('post.options'));
            $Tiku->description = $this->reImg(I('post.description'));
            switch(I('post.type')){
                case 4://多选
                    $Tiku->answer = json_encode(explode(',',I('post.answer')));
                default:
                    $Tiku->answer = $this->reImg(I('post.answer'));
            }
            $Tiku->ctime = date('Y-m-d H:i:s',time());
            $res = $Tiku->add();
            if($res){
                $this->success();
            }else{
                echo $Tiku->getDbError();
            }
        }else{
            $this->assign('Qcate',$this->Qcate);
            $this->assign('Qtype',$this->Qtype);
            $this->display();
        }
    }
    public function lists(){
        $Tiku = D('Tiku');
        $lists = $Tiku->select();
        foreach($lists as &$value){
            $value['category'] = $this->Qcate[$value['category']];
            $value['type'] = $this->Qtype[$value['type']];
        }
        $this->assign('lists',$lists);
        $this->display();
    }
    public function edit(){
        $Tiku = D('Tiku');
        if(IS_POST){
            $Tiku->create();
            $Tiku->options = json_encode(I('post.options'));
            $Tiku->description = $this->reImg(I('post.description'));
            switch(I('post.type')){
                case 4://多选
                    $Tiku->answer = json_encode(explode(',',I('post.answer')));
                default:
                    $Tiku->answer = $this->reImg(I('post.answer'));
            }
            $res = $Tiku->save();
            if($res){
                $this->success();
            }else{
                var_dump($Tiku->getDbError());exit;
                echo $Tiku->getError();
            }
        }else{
            $where['id'] = I('get.id');
            $info = $Tiku->where($where)->find();
            $info['options'] = json_decode($info['options'],true);
            $info['description'] = $this->backImg($info['description']);
            $info['answer'] = $this->backImg($info['answer']);
            $this->assign('Qcate',$this->Qcate);
            $this->assign('Qtype',$this->Qtype);
            $this->assign('info', $info);
            $this->display();
        }
    }
    public function del(){
        $Tiku = D('Tiku');
        $where['id'] = I('get.id');
        $res = $Tiku->where($where)->delete();
        if($res){
            $this->success('删除成功!');
        }else{
            $this->error('删除失败！');
        }
    }
}
<?php
namespace Home\Controller;
use Home\Common\CommonController;
class IndexController extends CommonController {
    protected $categorys = array(
        0=>'全部',
        1=>'前端',
        2=>'PHP语法',
        3=>'mysql',
        4=>'linux',
        5=>'算法',
        6=>'设计模式'
    );
    public function index(){
        $this->display();
    }
    public function lists($pagenow = 1, $category = 0){
        $Problems = D('Problems');
        $limit = 20;
        $where =array();
        $category?($where['category']=$category):'';
        $count = $Problems->where($where)->count();
        $pagecount = ceil($count/$limit);
        $lists = $Problems->where($where)->limit($limit*($pagenow-1).','.$limit)->select();
        $this->assign('pagenow', $pagenow);
        $this->assign('pagecount', $pagecount);
        $this->assign('categorys', $this->categorys);
        $this->assign('category', $category);
        $this->assign('lists', $lists);
        $this->display();
    }
    public function detail($id){
        $Problems = D('Problems');
        $id = $id?$id:I('param.id');
        $info = $Problems->where('id>='.$id)->find();
        if($info){
        $info['description'] = $this->backImg($info['description']);
        switch($info['type']){
            case 1://选择题
                $info['options'] = json_decode($info['options'], true);
                $info['answer'] = chr(65+$info['answer']);
                break;
            case 2://填空题
                break;
            case 3://简单题
                break;
            case 4://多选题
                $info['options'] = json_decode($info['options'], true);
                $info['answer'] = explode(',',$info['answer']);
                foreach($info['answer'] as &$val){
                    $val = chr(65+$val);
                }
                $info['answer'] = implode(',',$info['answer']);
                break;
        }
        }
//        var_dump($where['id']);exit;
        $this->assign('info', $info);
        $this->assign('session', session('uid'));
        $this->display('detail');
    }

    /**
     * 答题
     * @param int $id 问题id
     * @param mix $answer 问题答案
     */
    public function solve($id, $answer){
        if(!session('uid')){
            exit();
        }
        if(!($id||$answer)){
            $this->ajaxReturn(array('success'=>0, 'msg'=>'参数不能为空'));
        }
        $SolvePro = D('solvePro');
        $Problems = D('Problems');
        $info = $Problems->where("id=".$id)->find();
        switch($info['type']){
            case 1://单选题
                $data['is_right'] = $this->singleSel($answer, $info['answer']);
                $data['is_judge'] = 1;
                break;
            case 4://多选题
                $data['is_right'] = $this->multiSel($answer, explode(',',$info['answer']));
                $data['is_judge'] = 1;
                break;
            default:
                $data['is_judge'] = 0;
                $data['is_right'] = 2;
                break;
        }
        $data['uid'] = session('uid');
        $data['pid'] = $id;
        $data['answer'] = $answer;
        $data['ctime'] = date('Y-m-d H:i:s', time());
        if($SolvePro->add($data)){
            $this->ajaxReturn(array('success'=>1, 'msg'=>$id+1));
        }else{
            $this->ajaxReturn(array('success'=>0, 'msg'=>$SolvePro->getError()));
        }
    }

    /**
     * 单选题
     * @param string $answer 用户的答案
     * @param string $true_answer 正确答案
     * @return int 是否正确
     */
    protected function singleSel($answer, $true_answer){//保存的是key，而不是value
        if($answer==$true_answer){
            return 1;
        }else{
            return 0;
        }
    }
    /**
     * 多选题
     * @param array $answer 用户答案
     * @param array $true_answer 正确答案
     * @return int 是否正确
     */
    protected function multiSel($answer, $true_answer){//保存的是key，而不是value
        $res = array_diff($true_answer, $answer);
        if(count($res)){
            return 0;
        }else{
            return 1;
        }
    }
}
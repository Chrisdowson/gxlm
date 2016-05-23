<?php
namespace Admin\Common;
use Think\Controller;
class CommonController extends Controller {
    //问题分类
    public $Qcate = array(
        1=>'前端',
        2=>'php语法',
        3=>'mysql',
        4=>'linux',
        5=>'算法',
        6=>'设计模式',
        7=>'网络'
    );
    //问题类型
    public $Qtype = array(
        1=>'单选题',
        2=>'填空题',
        3=>'简答题',
        4=>'多选题'
    );
    public function _initialize(){
        if(session('uid')==''){
            $this->redirect('auth/login');
        }
    }

    /**
     * @description 上传图片
     * @param string $dir文件目录;
     *
     */
    public function UploadImg(){
        $dir = I('param.dirs','answer');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/upload/'; // 设置附件上传根目录
        $upload->savePath  =     "/".$dir."/"; // 设置附件上传（子）目录
        $upload->autoSub = true;
        $upload->subName = '';
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            \Org\My\Tool::json(array('error'=>1,'message'=>$upload->getError()));
        }else{// 上传成功
            foreach($info as $file){
                \Org\My\Tool::json(array('error'=>0,'url'=>'../../../Public/upload/'.$file['savepath'].$file['savename']));
            }
        }
    }
    /**
     * @description 替换图片链接
     * @param string $content 要替换的内容
     * @return string $res 替换后的内容;
     */
    public function reImg($content){
        $pattern="/src=\&quot;.*?\/Public\/upload\/(.*?)\&quot;/isu";
        $replacement='src="${1}"';
        $content=preg_replace($pattern, $replacement, $content);
        return $content;
    }
    /**
     * @description 还原图片链接
     * @param string $content 要替换的内容
     * @return string $res 替换后的内容
     *
     */
    public function backImg($content){
        $pattern = '/src=\"(.*?)\"/isu';
        $replacement = 'src="../../../public/upload/${1}"';
        $content = preg_replace($pattern, $replacement,$content);
        return $content;
    }
}
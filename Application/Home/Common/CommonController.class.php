<?php
namespace Home\Common;
use Think\Controller;
class CommonController extends Controller{
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
        return html_entity_decode($content);
    }
    public function uploadfile($maxSize, $exts){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     $maxSize ;// 设置附件上传大小
        $upload->exts      =     $exts;// 设置附件上传类型
        $upload->rootPath  =     './Public/upload/avatar/'; // 设置附件上传根目录
        $upload->autoSub   =    false;
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            return array('success'=>0, 'msg'=>$upload->getError());
        }else{// 上传成功
            return array('success'=>1, 'msg'=>'','path'=>$info['file']['savepath'].$info['file']['savename']);
        }
    }
}
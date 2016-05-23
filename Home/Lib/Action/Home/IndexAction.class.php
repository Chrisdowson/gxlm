<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	//获取微信发送数据
    	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    	//返回回复数据
    	if (!empty($postStr))
    	{
    		//解析xml数据
    		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    		//发送消息方ID
    		$FromUserName = $postObj->FromUserName;
    		//接收消息方ID
    		$ToUserName = $postObj->ToUserName;
    		//消息类型
    		$MsgType = $postObj->MsgType;
    		if ($MsgType == "event")
    		{
    			//$Content=eventAction($postObj,$FromUserName);
    			$Event=new EventAction($postObj);
    			
    		}//文本消息
    		elseif ($MsgType == "text"){
    			//$Content=textAction($message,$FromUserName);
    			$Text=new TextAction($postObj);
    			file_put_contents('content.txt','1233');
    		}//图片消息
    		elseif ($MsgType == "image"){
    			//$PicUrl=$postObj->PicUrl;
    			//$Content=pictureprocess($PicUrl,$FromUserName);
    			$Content='image';
    		}
    	}
    	//$resultStr = sprintf($textTpl, $FromUserName, $ToUserName, time(), $postObj->MsgType, $Content);
    //Var_dump($Text->res);
    }
}
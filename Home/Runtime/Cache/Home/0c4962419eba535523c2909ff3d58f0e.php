<?php if (!defined('THINK_PATH')) exit();?>			<xml>
            <ToUserName><![CDATA[<?php echo ($ToUserName); ?>]]></ToUserName>
            <FromUserName><![CDATA[<?php echo ($FromUserName); ?>]]></FromUserName>
            <CreateTime><?php echo ($time); ?></CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[<?php echo ($Content); ?>]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">l
	input,span{margin:0;padding:0;}
	.sty{width:100%;margin:0 auto;}
	.sty input{width:66%;height:50px;line-height:50px;font-size:16px;}
	.sty span{width:33%;height:50px;line-height:50px;font-size:16px;display:inline-block;}
	.sty .button{width:49%;margin:16px 0 0;cursor:pointer;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"
	content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<title>给分结果</title>
</head>
<body>
<form action="./?m=Bg&a=rpwd" method="post">
<div class="sty">
	<input type="hidden" name="scount" value="<?php echo ($scount); ?>">
	<span>密码：</span><input type="text" name="pwd"  id='chkcommon01'/><br/>
	<input type="submit" value="提交" class="button">
	<input type="reset" value="重置" class="button">
</div>
</form>
</body>
</body>
</html>
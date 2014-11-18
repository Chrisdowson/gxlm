<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=">
<title>登陆系统</title>
</head>
<body>
<div align="center">
<FIELDSET>
<LEGEND>系统登录</LEGEND>
<FORM action="loginprocess" method="post">
<label>用户名：</label>
<INPUT  type="text" name="username"/><br/>
<label> 密　码：</label>
<INPUT type="password" name="password"/><br/>
<INPUT type="submit" value="提交"/>
<INPUT type="reset" value="重置"/><br/>
</FORM>
</FIELDSET>
</div>
</body>
</html>
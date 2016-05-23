<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=">
<title>主界面</title>
</head>
<body>
<div align="center">
<FIELDSET>
<LEGEND>添加学校</LEGEND>
<form action="../Jwsys/addschool" method="post">
	<LABEL>学校全名</LABEL>
	<input type="text" name="schoolname"/><BR>
	<label>教务系统Url</label>
	<INPUT type="text" name="url"><br>
	<LABEL>教务系统类型</LABEL>
	<select name="sysno">
	<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$id): $mod = ($i % 2 );++$i;?><option value="<?php echo ($id["sysno"]); ?>"><?php echo ($id["sysname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select><br>
<input type="submit" value="提交"/>
<input type="reset" value="重置"/>
</form>
</FIELDSET>
</div>

<div align="center">
<FIELDSET>
<LEGEND>添加教务系统</LEGEND>
<form action="../Jwsys/addjwsys" method="post">
	<LABEL>教务系统全名</LABEL>
	<input type="text" name="sysname"/><br>
	<label>教务系统类名</label>
	<INPUT type="text" name="m_class"/><br>
<input type="submit" value="提交"/>
<input type="reset" value="重置"/>
</form>
</FIELDSET>
</div>

<div align="center">
    <FIELDSET>
        <LEGEND>手动添加用户信息</LEGEND>
        <form action="../Jwsys/addjwsys" method="post">
            <LABEL>教务系统全名</LABEL>
            <input type="text" name="sysname"/><br>
            <label>教务系统类名</label>
            <INPUT type="text" name="m_class"/><br>
            <input type="submit" value="提交"/>
            <input type="reset" value="重置"/>
        </form>
    </FIELDSET>
</div>
</body>
</html>
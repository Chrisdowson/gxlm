<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"
	content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<title>查课程给分高低</title>
</head>
<body>
	<form method="post" name="form_reg" action="./?m=Bifen&a=bifen">
		<table>
			<tr>
				<td colspan="3" align="center">
					<font color="#FF0000">模糊查询，输入课程某些字词，查询该课程给分高低</font>
				</td>
			</tr>
			<tr>
				<td>查询类别：</td>
				<td width="140" height="30">
					<select name="leibie" id="leibie">
						<option value="查询课程给分高低" selected="selected">查询课程给分高低</option>

					</select>
				</td>
			</tr>
			<br />
			<br />
			<tr>
				<td width="140" height="40">课程名称：</td>
				<td width="140" height="60">
					<input name="cxnr" type="text" id="cxnr" size="30" maxlength="40" />
				</td>
			</tr>
			<tr>
				<td align="right">
					<input name="submit" type="submit" id="submit" value="提交" />
				</td>
			</tr>
		</table>
	</form>


</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.{}org/1999/xhtml">
<title>绑定用户信息</title>
<style type="text/css">l
	input,span{margin:0;padding:0;}
	.sty{width:100%;margin:0 auto;}
	.sty input{width:66%;height:50px;line-height:50px;font-size:16px;}
	.sty span{width:33%;height:50px;line-height:50px;font-size:16px;display:inline-block;}
	.sty .button{width:49%;margin:16px 0 0;cursor:pointer;}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<META content="MSHTML 6.00.2900.3562" name=GENERATOR>
<script type='text/javascript'>
	function String_Check01(obj){
		var object=obj;
		var original= document.getElementById('chkcommon01').value;
		document.getElementById('chkcommon01').onblur=function(){
			if(document.getElementById('chkcommon01').value == ""){
				document.getElementById('chkcommon01').value = original;
			}
		};
		object = document.getElementById('chkcommon01');
		object.value="";
	}
	function String_Check02(obj){
		var object=obj;
		var original= document.getElementById('chkcommon02').value;
		document.getElementById('chkcommon02').onblur=function(){
			if(document.getElementById('chkcommon02').value == ""){
				document.getElementById('chkcommon02').value = original;
			}
		};
		object = document.getElementById('chkcommon02');
		object.value="";
	}
	function String_Check03(obj){
		var object=obj;
		var original= document.getElementById('chkcommon03').value;
		document.getElementById('chkcommon03').onblur=function(){
			if(document.getElementById('chkcommon03').value == ""){
				document.getElementById('chkcommon03').value = original;
			}
		};
		object = document.getElementById('chkcommon03');
		object.value="";
	}
	function String_Check04(obj){
		var object=obj;
		var original= document.getElementById('chkcommon04').value;
		document.getElementById('chkcommon04').onblur=function(){
			if(document.getElementById('chkcommon04').value == ""){
				document.getElementById('chkcommon04').value = original;
			}
		};
		object = document.getElementById('chkcommon04');
		object.value="";
	}

</script>
</head>

<body bgcolor="C3AE9B">
<?php  $wxcount=$_REQUEST['wxcount']; ?>
<form action="./?m=Register&a=registerprocess" method="post">
<div class="sty">
	<input type="hidden" name="wxcount" value="<?php echo $wxcount; ?>">
	<span>学号：</span><input type="text" name="scount" onclick="String_Check01(this)" id='chkcommon01'/><br/>
	<span>教务系统密码：</span><input type="text" name="pwd" value="初始值是身份证号码后6位" onclick='String_Check02()' id='chkcommon02'/><br/>
	<span>学校：</span><select name='schoolno' >
	<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$schoolinfo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($schoolinfo["schoolno"]); ?>"><?php echo ($schoolinfo["schoolname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select><br>
	<span>昵称：</span><input type="text" name="nickname"/><br/>
	<input type="submit" value="提交" class="button">
	<input type="reset" value="重置" class="button">
</div>
</form>
</body>

</html>
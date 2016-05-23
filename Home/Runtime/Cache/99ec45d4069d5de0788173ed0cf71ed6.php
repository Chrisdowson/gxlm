<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<link rel="stylesheet" href="style.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
<style type="text/css">
table{ background:#737373;
       
     }
table tr td{ background:#e9e7b8;
             font-size:75%;
			 text-align:center;
           }
table tbody tr{ background:#e9e7b8;
            
			 text-align:center;
           }
.ui-content{
             padding:10px;
           }
</style>
<SCRIPT type="text/javascript">
$(document).ready(function(){
	$(document).swipeleft(function(){
		var a=$.mobile.activePage.attr("id");
    	var match=/\d/;
    	var val=a.match(match);
		if(val>=0&&val<=6){
			val++;
		$.mobile.changePage( "#page"+val, { transition:"slidefade"});
		}else
		return false;
		return false;
	});
	$(document).swiperight(function(){
		var a=$.mobile.activePage.attr("id");
    	var match=/\d/;
    	var val=a.match(match);
    	if(val>=0&&val<=6){
    		val--;
		$.mobile.changePage( "#page"+val, { transition:"slidefade",reverse:"true"});
		}else
		return false;
		return false;
	})
})
</SCRIPT>
<title>课表</title>
</head>
<body>
<?php $__FOR_START_11199__=0;$__FOR_END_11199__=7;for($j=$__FOR_START_11199__;$j < $__FOR_END_11199__;$j+=1){ ?><div data-role="page" id="page<?php echo ($j); ?>">
	<div data-role="header"><h1>本学期课表</h1></div>
	<div data-role="content" >
		<table border="0" width="100%" class="course" cellspacing="1px">
			<tr><th colspan="2">周<?php echo ($arr[$j]); ?></th></tr>
			<?php $__FOR_START_652__=0;$__FOR_END_652__=6;for($i=$__FOR_START_652__;$i < $__FOR_END_652__;$i+=1){ ?><tr><td style="width:30%"><?php echo ($i*2+1); ?>,<?php echo ($i*2+2); ?>节</td><td><?php echo ($classes[$j][$i]); ?></td></tr><?php } ?>
		</table>
	</div>
	<div data-role="footer"><h2>copyright for 大学门</h2></div>
	</div><?php } ?>
</body>
</html>
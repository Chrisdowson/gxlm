<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>后台管理</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="Dennis Ji">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="/Public/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="/Public/public/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="/Public/public/css/style-responsive.css" rel="stylesheet">
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- end: CSS -->
    <script src="/Public/public/js/jquery-1.9.1.min.js"></script>
    <script src="/Public/public/kindeditor/kindeditor-min.js"></script>



    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="/Public/public/css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="/Public/public/css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- end: Favicon -->




</head>

<body>
<script type="text/javascript">
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[class="kindEditor"]', {
            allowFileManager : true,
            uploadJson  : './uploadimg.html?dirs=answer',
            afterUpload : function(data){
            }
        });
    });
</script>
<div class="navbar">
<div class="navbar-inner">
<div class="container-fluid">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<a class="brand" href="index.html"><span>后台管理</span></a>

<!-- start: Header Menu -->
<div class="nav-no-collapse header-nav">
<ul class="nav pull-right">
<!-- start: User Dropdown -->
<li class="dropdown">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="halflings-icon white user"></i> <?php echo $_COOKIE['username'];?>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
           <li><a href="../auth/logout.html"><i class="halflings-icon off"></i> 注销</a></li>
    </ul>
</li>
<!-- end: User Dropdown -->
</ul>
</div>
<!-- end: Header Menu -->

</div>
</div>
</div>
<div class="container-fluid-full">
    <div class="row-fluid">
        <div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="/index.php/Admin/index/index.html"><i class="icon-bar-chart"></i><span class="hidden-tablet"> 系统设置</span></a></li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-user"></i><span class="hidden-tablet"> 用 户</span></a>
                <ul>
                    <li><a class="submenu" href="/index.php/Admin/user/index.html">用户管理</a></li>
                    <li><a class="submenu" href="/index.php/Admin/user/feedback.html">意见反馈</a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> 题 库</span></a>
                <ul>
                    <li><a class="submenu" href="/index.php/Admin/tiku/add.html">添加题目</a></li>
                    <li><a class="submenu" href="/index.php/Admin/tiku/lists.html">查看题目</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
        <div id="content" class="span10">


<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">首页</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">用户</a></li>
</ul>


<div class="row-fluid sortable">
<div class="box span12">
<div class="box-header" data-original-title>
    <h2><i class="halflings-icon user"></i><span class="break"></span>用户管理</h2>
    <div class="box-icon">
        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
    </div>
</div>
<div class="box-content">
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
<tr>
    <th>id</th>
    <th>用户名</th>
    <th>手机号</th>
    <th>邮箱</th>
    <th>创建时间</th>
    <th>操作</th>
</tr>
</thead>
<tbody>
<?php if(is_array($lists)): foreach($lists as $key=>$lists): ?><tr>
        <td><?php echo ($lists["id"]); ?></td>
        <td class="center"><?php echo ($lists["username"]); ?></td>
        <td class="center"><?php echo ($lists["phone"]); ?></td>
        <td class="center"><?php echo ($lists["email"]); ?></td>
        <td class="center"><?php echo ($lists["ctime"]); ?></td>
        <td class="center">
            <a class="btn btn-success" href="#">
                <i class="halflings-icon white zoom-in"></i>
            </a>
            <a class="btn btn-info" href="#">
                <i class="halflings-icon white edit"></i>
            </a>
            <a class="btn btn-danger" href="#">
                <i class="halflings-icon white trash"></i>
            </a>
        </td>
    </tr><?php endforeach; endif; ?>
</tbody>
</table>
</div>
</div><!--/span-->

</div>
    </div>
</div>
<footer>
    <p>
        <span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>
    </p>
</footer>

<!-- start: JavaScript-->

<script src="/Public/public/js/jquery-migrate-1.0.0.min.js"></script>

<script src="/Public/public/js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="/Public/public/js/jquery.ui.touch-punch.js"></script>

<script src="/Public/public/js/modernizr.js"></script>

<script src="/Public/public/js/bootstrap.min.js"></script>

<script src="/Public/public/js/jquery.cookie.js"></script>

<script src='/Public/public/js/fullcalendar.min.js'></script>

<script src='/Public/public/js/jquery.dataTables.min.js'></script>

<script src="/Public/public/js/excanvas.js"></script>
<script src="/Public/public/js/jquery.flot.js"></script>
<script src="/Public/public/js/jquery.flot.pie.js"></script>
<script src="/Public/public/js/jquery.flot.stack.js"></script>
<script src="/Public/public/js/jquery.flot.resize.min.js"></script>

<script src="/Public/public/js/jquery.chosen.min.js"></script>

<script src="/Public/public/js/jquery.uniform.min.js"></script>

<script src="/Public/public/js/jquery.noty.js"></script>

<script src="/Public/public/js/jquery.elfinder.min.js"></script>

<script src="/Public/public/js/jquery.raty.min.js"></script>

<script src="/Public/public/js/jquery.iphone.toggle.js"></script>

<script src="/Public/public/js/jquery.uploadify-3.1.min.js"></script>

<script src="/Public/public/js/jquery.gritter.min.js"></script>

<script src="/Public/public/js/jquery.imagesloaded.js"></script>

<script src="/Public/public/js/jquery.masonry.min.js"></script>

<script src="/Public/public/js/jquery.knob.modified.js"></script>

<script src="/Public/public/js/jquery.sparkline.min.js"></script>

<script src="/Public/public/js/counter.js"></script>

<script src="/Public/public/js/retina.js"></script>

<script src="/Public/public/js/custom.js"></script>
<!-- end: JavaScript-->

</body>
</html>
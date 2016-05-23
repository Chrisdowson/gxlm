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
        <li><a href="#">题库</a></li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>增加题目</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="add.html" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="title">题目标题 </label>
                            <div class="controls">
                                <input type="text" class="span6 title" id="title"  name="title" data-provide="title">
                                <p class="help-block">请输入题目标题！</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="category">所属分类</label>
                            <div class="controls">
                                <select id="category" name="category">
                                    <?php if(is_array($Qcate)): foreach($Qcate as $key=>$cate): ?><option value="<?php echo ($key); ?>"><?php echo ($cate); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="type">难易程度</label>
                            <div class="controls">
                                <select id="type" name="difficulty">
                                        <option value="1">1星</option>
                                        <option value="2">2星</option>
                                        <option value="3">3星</option>
                                        <option value="4">4星</option>
                                        <option value="5">5星</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="type">是否显示</label>
                            <div class="controls">
                                <select id="type" name="is_show">
                                    <option value="1">显示</option>
                                    <option value="0">隐藏</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="type">题目类型</label>
                            <div class="controls">
                                <select id="type" name="type">
                                    <?php if(is_array($Qtype)): foreach($Qtype as $key=>$type): ?><option value="<?php echo ($key); ?>"><?php echo ($type); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="options">题目选项 </label>
                            <div class="controls">
                                <input type="text" class="span2 options" id="options" name="options[0]" data-provide="options">
                                <a id="addRowRaiseScale" class="btn" href="javascript:void(0)"><i class="halflings-icon plus"></i>添加</a>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="description">题目描述</label>
                            <div class="controls">
                                <textarea class="kindEditor" name="description" id="description" rows="3" style="height: 400px;"></textarea>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="answer">题目答案题目答案(答案填选项索引，多选加,)</label>
                            <div class="controls">
                                <textarea class="kindEditor" name="answer" id="answer" rows="3" style="height: 400px;"></textarea>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="answer">答案描述</label>
                            <div class="controls">
                                <textarea class="kindEditor" name="answer_des" id="answer_des" rows="3" style="height: 400px;"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">提 交</button>
                            <button type="reset" class="btn">取消</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

</div>
        <script type="text/javascript" src="/Public/admin/js/tiku.js"></script>
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
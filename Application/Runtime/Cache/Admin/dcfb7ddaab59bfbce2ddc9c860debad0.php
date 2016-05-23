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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->
    <script src="/Public/public/js/jquery-1.9.1.min.js"></script>


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
<div class="container-fluid-full">
        <div class="row-fluid">

    <div class="row-fluid">
        <div class="login-box">
            <div class="icons">
                <a href="../index/index.html"><i class="halflings-icon home"></i></a>
                <a href="#"><i class="halflings-icon cog"></i></a>
            </div>
            <h2>登陆</h2>
            <form class="form-horizontal" action="login.html" method="post">
                <fieldset>

                    <div class="input-prepend" title="email">
                        <span class="add-on"><i class="halflings-icon user"></i></span>
                        <input class="input-large span10" name="email" id="email" type="text" placeholder="type email"/>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend" title="Password">
                        <span class="add-on"><i class="halflings-icon lock"></i></span>
                        <input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
                    </div>
                    <div class="clearfix"></div>

                    <label class="remember" for="remember"><input type="checkbox" id="remember" />记住我</label>

                    <div class="button-login">
                        <button type="submit" class="btn btn-primary">登 陆</button>
                    </div>
                    <div class="clearfix"></div>
            </form>
        </div><!--/span-->
    </div><!--/row-->
    <script type="text/javascript">
        $("form").submit(function(e){
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            $.ajax({
                type:"post",
                url:'login.html',
                data:{
                 email:email,
                 password:password
                },
                success:function(data){
                    if(data.success=='0'){
                        alert(data.msg);
                    }else{
                        window.location.href = '../index/index.html';
                    }
                }
            })
        })
    </script>
    </div>
</div>
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

<script src="/Public/public/js/jquery.cleditor.min.js"></script>

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
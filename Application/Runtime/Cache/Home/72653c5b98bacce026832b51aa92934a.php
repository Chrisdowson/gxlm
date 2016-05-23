<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta content-type="text/javascript" charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/Public/public/css/bootstrap.min.css" />
    <!--<link rel="stylesheet" type="text/css" href="/Public/public/css/style-forms.css" />-->
    <!--<link rel="stylesheet" type="text/css" href="/Public/public/css/style.css" />-->
    <link rel="stylesheet" type="text/css" href="/Public/home/css/common.css" />
    <script type="text/javascript" src="/Public/public/js/jquery-1.9.1.min.js"></script>
    <title><?php echo ($title); ?></title>
</head>
<body class="hasLogo">
    <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/index.php/Home/index/index.html">PHP-TEST</a>
            <div class="nav-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="/index.php/Home/index/lists.html">题目列表</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_COOKIE['uid'])&&!empty($_COOKIE['uid'])){?>
                    <li><a href="../user/center.html?id=<?php echo $_COOKIE['uid'];?>" ><?php echo $_COOKIE['username'];?></a></li>
                    <li><a href="../user/logout.html" >登出</a></li>
                    <?php }else{?>
                    <li><a href="javascript:void(0);" onclick="LoginModal();">登录</a></li>
                    <li><a href="javascript:void(0);" onclick="RegisterModal();">快速注册</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--start 登陆弹出框-->
<div class="modal hide fade" id="login-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>登陆</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal login-form">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="username">用户名</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="username" name="login['username']" type="text" placeholder="请输入用户名…">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">密码</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="password" name="login['password']" type="password" placeholder="请输入密码…">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="btn" data-dismiss="modal">取消</a>
        <a href="javascript:void(0);" class="btn btn-primary" id="login">登陆</a>
    </div>
</div>
<!--end-->
<!--start 注册弹出框-->
<div class="modal hide fade" id="register-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>快速注册</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal register-form">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="reg_username">用户名</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="reg_username" name="register[username]" type="text" placeholder="请输入用户名…">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="reg_password">密码</label>
                    <div class="controls">
                        <input class="input-xlarge focused"  id="reg_password" name="register[password]" type="password" placeholder="请输入密码…">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="reg_repassword">确认密码</label>
                    <div class="controls">
                        <input class="input-xlarge focused"  id="reg_repassword" name="register[repassword]" type="password" placeholder="请再次输入密码…">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="btn" data-dismiss="modal">取消</a>
        <a href="javascript:void(0);" class="btn btn-primary" id="register">注册</a>
    </div>
</div>
<!--end-->
<script type="text/javascript" src="/Public/home/js/navbar.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/home/css/lists.css" />
<div class="center">
    <ul class="nav nav-tabs nav-tabs-zen mb10">
        <?php if(is_array($categorys)): foreach($categorys as $k=>$categorys): ?><li class="<?php if($category==$k){ echo 'active';}?>"><a href="?category=<?php echo $k;?>"><?php echo $categorys;?></a></li><?php endforeach; endif; ?>
    </ul>
    <div class="ques-lists">
        <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lists): $mod = ($i % 2 );++$i;?><section class="select-items"><a href="detail.html?id=<?php echo ($lists["id"]); ?>"><?php echo ($lists["title"]); ?></a></section><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php echo W('LinkPager/LinkPager',array($pagecount,$pagenow,$category));?>
</div>
    <div class="floating_bar">
    <div class="f_item f_item_consult">
        <i class="deco"></i>
        <div class="reality"><a target="_blank" onclick="FeedbackModal();" href="javascript:void(0);">反馈</a></div>
    </div>
</div>
<!--start 反馈弹出框-->
<div class="modal hide fade" id="feedback-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>意见反馈</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal register-form">
            <textarea  class="cleditor" id="content" name="content" type="text" style="width: 100%;height: 100px;"></textarea>
        </form>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="btn" data-dismiss="modal">取消</a>
        <a href="javascript:void(0);" class="btn btn-primary" id="feedback">确定</a>
    </div>
</div>
<!--end-->
    <script type="text/javascript" src="/Public/home/js/floatbar.js"></script>
    <footer class="footer">
    <div class="container">
    </div>
</footer>
</body>
<script type="text/javascript" src="/Public/public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/public/js/jquery.form.js"></script>
<script type="text/javascript">
    function LoginModal(){
        $("#login-modal").modal('show');
    }
    function RegisterModal(){
        $("#register-modal").modal('show');
    }
    function FeedbackModal(){
        $("#feedback-modal").modal('show');
    }
</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta content-type="text/javascript" charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/Public/public/css/bootstrap.min.css" />
    <!--<link rel="stylesheet" type="text/css" href="/Public/public/css/style-forms.css" />-->
    <!--<link rel="stylesheet" type="text/css" href="/Public/public/css/style.css" />-->
    <link rel="stylesheet" type="text/css" href="/Public/home/css/common.css" />
    <script type="text/javascript" src="/Public/public/js/jquery-1.9.1.min.js"></script>
    <title>首页</title>
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
        <div class="center">
    <form action="./solve.html" method="post">
        <?php if(!empty($info)){?>
        <input name="id" type="hidden" value="<?php echo $info['id'];?>"/>
        <!--题目标题-->
        <h5 class="ques-title">Q.<?php echo $info['title'];?></h5>
        <?php if(!empty($info['description'])){?>
        <div class="description"><?php echo $info['description'];?></div>
        <?php }?>
        <div class="answer">
            <?php if(1==$info['type']||4==$info['type']){?>
            <!--题目答案选项-->
            <div class="ques-items">
                <?php  foreach($info['options'] as $key => $value){?>
                    <div class="radio">
                        <?php if(1==$info['type']){?>
                        <label><input type="radio" name="answer" value="<?php echo $key;?>"><?php echo $value;?>;</label>
                        <?php }else{ ?>
                        <label class="checkbox-inline"><input type="checkbox" name="answer[]" value="<?php echo $key;?>"> <?php echo $value;?></label>
                        <?php } ?>
                    </div>
                <?php }?>
            </div>
            <?php }else{?>
            <!--填空题目答案-->
            <div class="ques-tiankong">
                <input type="hidden" value="" />
                <textarea class="form-control" rows="3" style="width: 50%;height: 300px;"></textarea>
            </div>
            <?php }?>
        </div>
        <div class="true_answer">
            <div class="accordion" id="accordion2">
                <div class="accordion-group">
                    <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" style="text-decoration:none;">
                        点击查看正确答案­­­­­→
                    </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse" style="height: 0px; text-align: left;">
                    <div class="accordion-inner">
                        答案：<br/><?php echo (html_entity_decode($info["answer"])); ?>
                    </div>
                    <div class="accordion-inner">
                        答案说明：<br/><?php echo ($info["answer_des"]); ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php if($session){?>
        <!--上一题和下一题-->
        <div class="ques-navi"><input class="btn btn-lg btn-primary" type="submit" value="提 交"></div>
        <?php }?>
        <?php }else{?>
            <p class="text-error">木有题目咯~</p>
        <?php }?>
    </form>
</div>
<script type="text/javascript" src="/Public/home/js/detail.js"></script>
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
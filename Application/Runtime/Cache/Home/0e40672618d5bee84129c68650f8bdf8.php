<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta content-type="text/javascript" charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/Public/public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/public/css/style-forms.css" />
    <link rel="stylesheet" type="text/css" href="/Public/public/css/style.css" />
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
    <div class="container center layout_n">
        <div class="m_center">
            <div class="m_side_wrap">
    <div class="m_side">
        <div class="m_side_avatar">
            <div class="figure">
                <img id="left_nick_img" src="<?php
 if($info['avatar']){ echo '../../../public/upload/avatar/'.$info['avatar']; }else{ echo '../../../public/home/img/user/avatar_02.png'; } ?>">
            </div>
            <div class="nickname"><?php echo $_COOKIE['username'];?></div>
        </div>
        <div class="m_side_menu">
            <ul>
                <li class="menu_item">
                    <div class="menu_item_link">
                        <i class="menu_ico menu_ico_01"></i>
                        <a>个人中心</a>
                        <i class="caret"></i>
                    </div>
                    <div class="sub_menu">
                        <ul>
                            <li class="sub_menu_item <?php if(ACTION_NAME=='center'){echo 'active';}?>"><a href="./center.html">个人资料</a></li>
                            <li class="sub_menu_item <?php if(ACTION_NAME=='repwd'){echo 'active';}?>"><a href="./repwd.html">修改密码</a></li>
                            <li class="sub_menu_item <?php if(ACTION_NAME=='testlog'){echo 'active';}?>"><a href="./testlog.html">测试记录</a></li>
                        </ul>
                    </div>
                </li>
                </li>
            </ul>
        </div>
    </div>
</div>

            <div class="m_main_wrap m_form m_account_pwd">
    <div class="m_main">
        <div class="m_block1">
            <div class="m_block1_hd">
                <div class="block_tit">
                    <i class="stick"></i>
                    <div class="caption">重置密码</div>
                </div>
                <div class="block_linethrough"></div>
            </div>
            <div class="m_block1_bd">
                <div class="m_message_box">
                    <p><span class="f_999">友情提示：</span>互联网帐号存在被盗风险，建议定期修改密码以保护帐号安全。</p>
                </div>
                <form id="repwdForm" action="/member/repwd" method="post">
                    <div class="form_line">
                        <div class="input_wrap">
                            <label class="input_label"><i class="required">*</i>原 密 码：</label>
                            <div class="input_control has_symbol error">
                                <i class="ui_ico ui_ico_lock"></i>
                                <input class="input_txt" maxlength="20" name="UserForm[password]" id="UserForm_password" style="width:270px;height:42px!important;" type="password">                        </div>
                            <div class="m_message m_message_warning"><i class="ui_ico ui_ico_005"></i><span class="" id="UserForm_password_em_" style="">密码不能为空-请输入密码</span></div>
                        </div>
                    </div>

                    <div class="form_line">
                        <div class="input_wrap">
                            <label class="input_label"><i class="required">*</i>新 密 码：</label>
                            <div class="input_control has_symbol error">
                                <i class="ui_ico ui_ico_lock"></i>
                                <input class="input_txt" maxlength="20" name="UserForm[newPassword]" id="UserForm_newPassword" style="width:270px;height:42px!important;" type="password">                        </div>
                            <div class="m_message m_message_warning"><i class="ui_ico ui_ico_005"></i><span class="" id="UserForm_newPassword_em_" style="">请输入新密码</span></div>
                        </div>

                    </div>

                    <div class="form_line">
                        <div class="input_wrap">
                            <label class="input_label"><i class="required">*</i>确认密码：</label>
                            <div class="input_control has_symbol success">
                                <i class="ui_ico ui_ico_lock"></i>
                                <input class="input_txt" maxlength="20" name="UserForm[cNewPassword]" id="UserForm_cNewPassword" style="width:270px;height:42px!important;" type="password">                        </div>
                            <div class="m_message m_message_warning"><span class="" id="UserForm_cNewPassword_em_" style="display: none;"></span></div>
                        </div>
                    </div>
                    <div class="form_line form_controls">
                        <div class="input_wrap">
                            <label class="input_label">&nbsp;</label>
                            <div class="input_control">
                                <a href="#" class="uc_btn uc_btn_orange" id="btn_resetpwd">提交</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        </div>
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
<link rel="stylesheet" type="text/css" href="/Public/home/css/center.css" />
<script type="text/javascript" src="/Public/home/js/center.js"></script>
<script type="text/javascript" src="/Public/public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/public/js/jquery.form.js"></script>
<script type="text/javascript" src="/Public/public/js/jquery.noty.js"></script>
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
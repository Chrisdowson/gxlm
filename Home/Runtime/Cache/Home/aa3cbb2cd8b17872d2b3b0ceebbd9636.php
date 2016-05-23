<?php if (!defined('THINK_PATH')) exit(); ?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="__CSS__bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__bootstrap-responsive.min.css" />
    <script href="__JS__bootstrap.min.js"></script>
    <script href="__JS__jquery.js"></script>
    <title>测试</title>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">
        <form>
            <div class="form-group">
                <label for="Controller">Controller</label>
                <input type="text" class="form-control" id="Controller" placeholder="Controller">
            </div>
            <div class="form-group">
                <label for="Action">Action</label>
                <input type="text" class="form-control" id="Action" placeholder="Action">
            </div>
            <div class="form-group">
                <label for="scount">请输入学号</label>
                <input type="text" class="form-control" id="scount" placeholder="请输入学号">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" id="password" placeholder="教务系统密码">
            </div>
            <button type="submit" class="btn btn-default" id="submit">提交</button>
            <p>
                <pre id="respons">

                </pre>
            </p>
        </form>
    </div>
</div>
</body>
<script type="application/javascript">
    $('#submit'),on('click',function(e){
        e.preventDefault();
        var controller = $('#controller').val();
        var action = $('#action').val();
        var scount = $('#scount').val();
        var password = $('#password').val();
        if(controller&&action&&scount&&password){
            $.ajax({
                url:'./'+controller+'/'+action,
                type:'post',
                data:{scount:scount,password:password},
                success:function(data){
                    $('#respons').html(data);
                }
            })
        }
    })
</script>
</html>
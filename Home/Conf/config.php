<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_L_DELIM'=>'<{',//修改左定界符
	'TMPL_R_DELIM'=>'}>',//修改右定界符
		//数据库配置信息
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'gxlm', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => '', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => '',// 数据库表前缀
		//其他项目配置参数
		'APP_GROUP_LIST' => 'Home,Admin', //项目分组设定
		'DEFAULT_GROUP'  => 'Home', //默认分组
		'URL_CASE_INSENSITIVE' =>true,//设置系统url不区分大小写
        'IS_PRODUCT' => true,//是否是生产环境
		//'SHOW_PAGE_TRACE'=>true,
		'TMPL_PARSE_STRING'=>array(
				'__CSS__'=>__ROOT__.'/Public/css/',
				'__JS__'=>__ROOT__.'/Public/js/',
),
);
?>
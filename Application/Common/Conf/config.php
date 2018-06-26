<?php
return array(
	//'配置项'=>'配置值'
		'URL_MODEL'=>1,//url模式设置	
		'SHOW_PAGE_TRACE'       =>false,//让页面显示追踪日志信息	
		'URL_CASE_INSENSITIVE'  => true,//设置不区分大小写
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址     该地方不能写为localhost:80 
		'DB_NAME'               =>  'ac',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  'root',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
		'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
		'DB_SQL_BUILD_CACHE'    => true,     //SQL解析缓存
		'DB_SQL_BUILD_LENGTH'   => 20,      // SQL缓存的队列长度
		'URL_HTML_SUFFIX'       => 'html|shtml|xml', //伪静态
		'APP_DEBUG'             => false,     //开发调试模式
		'LOG_LEVEL'             =>'EMERG,ALERT,CRIT,ERR',
		'LOG_TYPE'              =>  'File',
		'VAR_PAGE'              =>'page',
		'SHOW_PAGE_TRACE'		=>'true',
);
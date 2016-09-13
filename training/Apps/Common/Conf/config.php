<?php
return array(
			
		// '配置项'=>'配置值'
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => 'qs', // 服务器地址
		'DB_NAME' => 'training', // 数据库名
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => 'root', // 密码
		'DB_PORT' => 3306, // 端口
		'DB_PREFIX' => 'tt_', // 数据库表前缀
		
		'MODULE_ALLOW_LIST' => array (
				'Home',
				'Admin',
				'Photos'
		),
		'DEFAULT_MODULE' => 'Home', // 默认模块
		'URL_MODEL' => 2, // URL模式
		'URL_CASE_INSENSITIVE'=>true,
		
		//自定义配置项
		'IMAGE_PATH' => './Uploads/',
		'PHOTOS_IMAGE_PATH' => './Uploads/photos/'
);

// return array(
			
// 		// '配置项'=>'配置值'
// 		'DB_TYPE' => 'mysql', // 数据库类型
// 		'DB_HOST' => 'rds1t609sm8q8n4bc603.mysql.rds.aliyuncs.com', // 服务器地址
// 		'DB_NAME' => 'r7kpv4lm42', // 数据库名
// 		'DB_USER' => 'r7kpv4lm42', // 用户名
// 		'DB_PWD' => 'r7kpv4lm42', // 密码
// 		'DB_PORT' => 3306, // 端口
// 		'DB_PREFIX' => 'tt_', // 数据库表前缀

// 		'MODULE_ALLOW_LIST' => array (
// 				'Home',
// 				'Admin',
//				'Photos'
// 		),
// 		'DEFAULT_MODULE' => 'Home', // 默认模块
// 		'URL_MODEL' =>2, // URL模式
// 		'URL_CASE_INSENSITIVE'=>true,

// 		//自定义配置项
// 		'IMAGE_PATH' => './Uploads/',
//		'PHOTOS_IMAGE_PATH' => './Uploads/photos/'
// );
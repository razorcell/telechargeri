<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Telechargeri Admin Panel',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.runactions.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				
			/*
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',// \w : word characters (letters, digits, and underscores)
				// \d : a digit, [\d\s] matches a character that is a digit or whitespace
				// + : ".+" matches "def" "ghi" in abc "def" "ghi" jkl
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',*/
					'administration'=>'administration/index',
					'administration/websites'=>'administration/website_list',
					'administration/operatingsystems'=>'administration/os_list',
					'administration/applications'=>'administration/appsgrabb',
					'administration/categories'=>'administration/category_list',
					'administration/sections'=>'administration/section_list',
					
					'website_add'=>'administration/website_add',
					'website_edit'=>'administration/website_edit',
					'website_delete'=>'administration/website_delete',
					'website_update'=>'administration/website_update',
					
					'os_add'=>'administration/os_add',
					'os_edit'=>'administration/os_edit',
					'os_delete'=>'administration/os_delete',
					'os_update'=>'administration/os_update',
					
					'category_add'=>'administration/category_add',
					'category_edit'=>'administration/category_edit',
					'category_delete'=>'administration/category_delete',
					'category_update'=>'administration/category_update',
					
					'section_add'=>'administration/section_add',
					'section_edit'=>'administration/section_edit',
					'section_delete'=>'administration/section_delete',
					'section_update'=>'administration/section_update',
					
					'applications'=>'administration/applications',
					
					'info'=>'administration/get_scan_info',
					'start'=>'administration/start,'
					
					
					//'home'=>'/site/index',	
			),
				'showScriptName'=>false,
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=telechargeri',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'xampp',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
		'layout'=>'dandelion',
);
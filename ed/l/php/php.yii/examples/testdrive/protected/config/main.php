<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'forum',
		'admin' => array(
			'modules'=>array(
				'subadmin',
			),
		),
		'store',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
        'QRCode' => [
            'class' => 'application\components\QRCode',
            'scope' => 'global',
        ],
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'/forum/create' => 'forum/post/create/index',
				'/forum' => 'forum/post/get/index',
				'/admin' => 'admin/admin/index',
				'/subadmin' => 'admin/subadmin/admin/index',
				'/store' => 'store/guest/index',
				'/site' => 'site',
				'/site2' => 'site/ping',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		'db'=>array(
			'connectionString' => 'mysql:host=xmysql;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'user',
			'password' => 'pass',
			'charset' => 'utf8',
		),
		'dbUnitTest'=>array(
			'class' => 'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=testdrive_unit_test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                /*
                array(
                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1'),
                ),
                */
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					'categories' => 'system.*',
					'logFile' => 'debug.tmp.sql.log',
				),
				array(
					'class'=>'CWebLogRoute',
					'showInFireBug' => true,
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
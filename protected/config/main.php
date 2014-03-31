<?php
/*
This configuration is modify by jeef contact: saimaiazz@gmail.com
Copy right under MIT license
*/


// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'LogDailyBoon Project',
	
	// 'sourceLanguage' => 'en_us' ,
	// 'language' => 'th' ,
	
    // preloading 'log' component
    // 'preload' => array('log', 'bootstrap', ),
   
   'defaultController' => 'nodes/index',
   
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
		'ext.giix-components.*',
    ),
	
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        //	'ipFilters'=>array('127.0.0.1','::1'),
				
			'generatorPaths' => array(
				'bootstrap.gii',
				'ext.giix.giix-core', // giix generators
			),
        ),
		
    ),
	
	'theme'=>'bootstrap',

	
    // application components
    'components' => array(
		
		'request'=>array(
			'class' => 'CHttpRequest',
            'enableCookieValidation'=>true ,
			'enableCsrfValidation'=>true ,
        ),
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
			//'responsiveCss' => true,
		),
		'yiinfinitescroller'=>array(
			'class'=>'ext.yiinfinite-scroll.YiinfiniteScroller',
		),		
		'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            'driver'=>'GD',
        ),		
		'session' => array (
			'autoStart' => true,			
			//'sessionName' => 'Site Access',
			//'cookieMode' => 'only',
			//'savePath' => '/path/to/new/directory',			
		),		
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),		
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules'=>array(
            '<language:(th|en)>/' => 'site/index',
            '<language:(th|en)>/<action:(contact|login|logout)>/*' => 'site/<action>',
            '<language:(th|en)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
            '<language:(th|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            '<language:(th|en)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
        ),
        'showScriptName' => false,
			//  'urlSuffix'=>'.html',
        ),		
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=record_boon',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'trace',
                    'categories' => 'test', // specify log to render
                    'showInFireBug' => true
                ),
                // uncomment the following to show log messages on web pages
                /* 
                array(
                    'class' => 'CWebLogRoute',
                ),
                */
            ),
        ),		
		'config' => array(
			'class' => 'ext.yii-mail.YiiMailMessage',
		),		
		'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType'=>'smtp',
			'transportOptions'=>array(
					'host'=>'mail.logdailyboon.com',
					'username'=>'boon',
					'password'=>'asdf1234',
					'port'=>'25',                       
			),
			'viewPath' => 'application.views.mail',             
		),		
		'ePdf' => array(
			'class'         => 'ext.yii-pdf.EYiiPdf',
			'params'     => array(
				'mpdf'     => array(
					'librarySourcePath' => 'application.vendors.mpdf.*',
					'constants'         => array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
					/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
						'mode'              => '', //  This parameter specifies the mode of the new document.
						'format'            => 'A4', // format A4, A5, ...
						'default_font_size' => 0, // Sets the default document font size in points (pt)
						'default_font'      => '', // Sets the default font-family for the new document.
						'mgl'               => 15, // margin_left. Sets the page margins for the new document.
						'mgr'               => 15, // margin_right
						'mgt'               => 16, // margin_top
						'mgb'               => 16, // margin_bottom
						'mgh'               => 9, // margin_header
						'mgf'               => 9, // margin_footer
						'orientation'       => 'P', // landscape or portrait orientation
					)*/
				),
			),
		),
			
    ), // end components
	
	
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'saimaiazz@gmail.com',
		'languages'=>array('th'=>'ไทย', 'en'=>'English'),
    ),

);
<?php
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/apps');

return [
	'app' => [
		'base_url'      => '/liparent/',
		'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
	],
	'db' => [
		'adapter'  => 'Mysql',
		'host'     => 'localhost',
		'username' => 'root',
		'password' => '',
		'name'     => 'liparent',
	],

	'mail' => [
		'fromName' => 'Lipa Rent Admin',
		'fromEmail' =>  'chrizota@gmail.com',
		'smtp' =>[
			'server'	=> 'smtp.gmail.com',
			'port' 		=> 465,
			'security' => 'ssl',
			'username' => 'chrizota@gmail.com',
			'password' => 'Chrispine2015',
		]
	]

];


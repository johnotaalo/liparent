<?php

return [
	'app' => [
		'base_url'      => '/liparent/',
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


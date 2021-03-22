<?php defined('SYSPATH') or die('No direct access allowed.');

// Для localhost
if ($_SERVER['REMOTE_ADDR']=='127.0.0.1')
{
	return array
	(
		'default' => array
		(
			'type'       => 'mysql',
			'connection' => array(
				'hostname'   => 'localhost',
				'database'   => 'kosmopoisk',
				'username'   => 'root',
				'password'   => 'root',
				'persistent' => FALSE,
			),
			'table_prefix' => '',
			'charset'      => 'utf8',
			'caching'      => false,
			'profiling'    => TRUE,
		)
	);
}

// Для сервера
else
{
	return array
	(
		'default' => array
		(
			'type'       => 'mysql',
			'connection' => array(
                'hostname'   => 'localhost',
                'database'   => 'kosmopoisk',
                'username'   => 'root',
                'password'   => 'root',
				'persistent' => FALSE,
			),
			'table_prefix' => '',
			'charset'      => 'utf8',
			'caching'      => FALSE,
			'profiling'    => Kohana::$environment !== Kohana::PRODUCTION,
		)
	);
}
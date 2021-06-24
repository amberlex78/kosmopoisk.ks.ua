<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	/**
	 * CSS files
	 */
	'css' => array (

		// В app - стили, которые грузятся всегда
		'app' => array(

			'assets/vendors/bootstrap/css/bootstrap.min.css',
			'assets/vendors/bootstrap/css/bootstrap-responsive.min.css',
			'assets/vendors/awesome/css/font-awesome.min.css',

			// Мои стили
			'assets/css/style.css',
		),

		// Стили для контроллеров
	),

	/**
	 * JS files
	 */
	'js' => array(

		// В app - cкрипты, которые грузятся всегда
		'app' => array(

			'assets/vendors/jquery-1.12.4.min.js',
			'assets/vendors/bootstrap/js/bootstrap.min.js',

			// Основной скрипт приложения
			'assets/js/app.js'
		),
	),
);

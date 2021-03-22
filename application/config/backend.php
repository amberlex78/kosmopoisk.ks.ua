<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	/**
	 * CSS files
	 */
	'css' => array(

		// В app - стили, которые грузятся всегда
		'app' => array(

			'assets/vendors/bootstrap/css/bootstrap.min.css',
			'assets/vendors/bootstrap/css/bootstrap-responsive.min.css',

			// Мои стили
			'assets/backend/css/style.css',
		),

		// Стили для контроллеров
		'auth' => array(
			'assets/backend/css/auth.css',
		),
	),

	/**
	 * JS files
	 */
	'js' => array(

		// В app - cкрипты, которые грузятся всегда
		'app' => array(

			'assets/vendors/jquery-1.7.2.min.js',
			'assets/vendors/bootstrap/js/bootstrap.min.js',

			// Основной скрипт приложения
			'assets/backend/js/app.js',
		),

		// Скрипты для контроллеров
		'statics' => array(
			'assets/backend/js/statics.js'
		),
		'publications' => array(
			'assets/backend/js/publications.js',
			'assets/vendors/ajaxupload.js',
		),
	),

	/**
	 * Блоки меню для админки
	 */
	'blocks' => array(

		// Статические страницы
		'statics' => array(
			'heading' => 'statics.heading',
			'icon'    => 'file',
			'menu'    => array(
				array(
					'title'      => 'statics.manager_pages',
					'controller' => 'statics',
					'action'     => 'pages',
					'icon'       => 'list-alt',
				),
			)
		),

		// Публикации (категории и статьи)
		'publications' => array(
			'heading' => 'publications.heading',
			'icon'    => 'book',
			'menu'    => array(
				array(
					'title'      => 'publications.manager_categories',
					'controller' => 'publications',
					'action'     => 'categories',
					'icon'       => 'th-list',
				),
				array(
					'title'      => 'publications.manager_articles',
					'controller' => 'publications',
					'action'     => 'articles',
					'icon'       => 'list-alt'
				),
				array(
					'title'      => 'settings.manager_module',
					'controller' => 'publications',
					'action'     => 'settings',
					'icon'       => 'cog'
				),
			)
		),
	),
);
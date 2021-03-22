<?php defined('SYSPATH') or die('No direct script access.');

if ( ! Route::cache())
{
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Общие роуты

	Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
		->defaults(array(
		'directory'  => 'frontend',
		'controller' => 'error',
	));

	// Для работы с ajax
	Route::set('ajax', '<directory>/<controller>/<action>(/<id>)', array(
		'directory'  => 'ajax',
		'controller' => '[a-z0-9_]+',
		'action'     => '[a-z0-9_]+',
		'id'         => '.+'
	));


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Backend routes (админские)

	// Авторизация
	Route::set('backend_auth', ADMIN . '(/)<action>', array('action' => 'login|logout'))
		->defaults(array(
		'directory'  => 'backend',
		'controller' => 'auth',
		'action'     => 'login',
	));

	// Основной роут, для админки пока будет достаточно
	Route::set('backend', ADMIN . '(/)(<controller>(/<action>(/page-<page>)(/<id>)))', array('page' => '\d+', 'id'=>'\d+'))
		->defaults(array(
		'directory'  => 'backend',
		'controller' => 'dashboard',
		'action'     => 'index'
	));


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Frontend routes (клиентские)

	// Главная
	Route::set('home', '(page-<page>)', array('page' => '\d+'))
		->defaults(array(
		'directory'  => 'frontend',
		'controller' => 'home',
		'action'     => 'index'
	));

	//Поиск
	Route::set('search', 'search(/<tag>)(/page-<page>)', array('tag' => '[-a-z0-9_]+', 'page' => '\d+'))
		->defaults(array(
		'directory'  => 'frontend',
		'controller' => 'search',
		'action'     => 'index',
	));

	//Статические страницы
	Route::set('statics', '<slug>', array('slug' => '[-a-z0-9_]+'))
		->defaults(array(
		'directory'  => 'frontend',
		'controller' => 'statics',
		'action'     => 'index',
	));

	//Публикации
	Route::set('publications', '<action>(/<slug>)(/page-<page>)', array('action' => 'category|article', 'slug' => '[-a-z0-9_]+', 'page' => '\d+'))
		->defaults(array(
		'directory'  => 'frontend',
		'controller' => 'publications',
	));

	// Дефолтный роут всегда последний
	Route::set('default', '(<controller>(/<action>(/<id>)))')
		->defaults(array(
		'directory'  => 'frontend',
		'controller' => 'home',
		'action'     => 'index'
	));

	// Кешируем роуты, если продакшн
	Route::cache(Kohana::$environment === Kohana::PRODUCTION);
}

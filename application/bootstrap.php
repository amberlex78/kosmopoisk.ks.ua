<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Тут наши изменения

/**
 * Генерим соль для кукисов для нового проекта
 * Генерим здесь: https://www.grc.com/passwords.htm
 */
Cookie::$salt = 'YpPmi7I4ldLssXX4iBMriP07zuWF9iTCJTjmYP1m2qRteoiUEGSgVpgXcQ49wEv';

/*
// Можно использовать эту конструкцию
if ($_SERVER['REMOTE_ADDR']=='127.0.0.1')
	Kohana::$environment = Kohana::DEVELOPMENT;
else
	Kohana::$environment = Kohana::PRODUCTION;

// Или устанавливать в .htaccess (установленно)
// SetEnv KOHANA_ENV development
// SetEnv KOHANA_ENV production
*/

// Если продакшн
if (Kohana::$environment === Kohana::PRODUCTION)
{
	// Выключаем уведомления и строгие ошибки
	error_reporting(E_ALL & ~E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url' => $_SERVER['HTTP_HOST']=='kosmopoisk.test'
		? 'http://kosmopoisk.test'
		: 'https://kosmopoisk.ks.ua',
	'index_file' => FALSE,
	'errors'     => TRUE,
	'profile'    => Kohana::$environment !== Kohana::PRODUCTION, // Разрешаем или запрещаем профилирование
	'caching'    => Kohana::$environment === Kohana::PRODUCTION, // Разрешаем или запрещаем кеширование
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	'cache'      => MODPATH.'cache',      // Caching with multiple backends
	'database'   => MODPATH.'database',   // Database access
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	'orm_mptt'   => MODPATH.'orm-mptt',   // MPTT Library (Nested Sets)
	'email'      => MODPATH.'email',      // Swift Mailer
	'captcha'    => MODPATH.'captcha',    // captcha 3.2
	'pagination' => MODPATH.'pagination', // Pagination
));

// Подключаем константы
require(APPPATH.'constants'.EXT);

// Подключаем роуты
require(APPPATH.'routes'.EXT);

// Vendors
require_once Kohana::find_file('vendors', 'phpthumb/ThumbLib.inc');

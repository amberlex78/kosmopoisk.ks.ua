<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Главный системный контроллер приложения
 */
class Controller_System_Controller extends Kohana_Controller
{
	// Для работы с сессией
	public $session;

	// Для работы с конфигом
	public $config;

	// Для работы с кешем
	public $cache;

	// Язык для приложения
	public $language;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Before action
	 */
	public function before()
	{
		parent::before();

		$this->session = Session::instance();
		$this->config  = Kohana::$config->load('app');
		$this->cache   = Cache::instance($this->config->cache_driver);

		// Получаем язык для приложения
		$this->language = $this->config['default_language'];

		/**
		 * Установка временной зоны.
		 *
		 * @link http://kohanaframework.org/guide/using.configuration
		 * @link http://www.php.net/manual/timezones
		 */
		date_default_timezone_set($this->config['timezone']);

		/**
		 * Установка локали
		 *
		 * @link http://kohanaframework.org/guide/using.configuration
		 * @link http://www.php.net/manual/function.setlocale
		 */
		setlocale(LC_ALL, $this->config['languages'][$this->language] . '.utf-8');

		/**
		 * Устанавливаем язык приложения
		 * Обеспечивает загрузку языка и перевода
		 */
		I18n::lang($this->language);
	}


	/**
	 * Возвращаем true, если GET запрос
	 *
	 *      $this->request->is_get();
	 *
	 * @return boolean
	 */
	public function is_get()
	{
		return ($this->request->method() === Request::GET);
	}

	/**
	 * Возвращаем true, если POST запрос
	 *
	 *      $this->request->is_post();
	 *
	 * @return boolean
	 */
	public function is_post()
	{
		return ($this->request->method() === Request::POST);
	}
}


////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Время работы и память используемая приложением
 *
 * @return string
 */
function usage_time_and_memory()
{
	return
		'Time: '   . number_format((microtime(TRUE) - KOHANA_START_TIME), 4) . 's | ' .
		'Memory: ' . number_format((memory_get_usage() - KOHANA_START_MEMORY) / 1024 / 1024  , 1) . 'MB';
}

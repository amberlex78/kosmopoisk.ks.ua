<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Extend the Kohana Date helper
 */
class Date extends Kohana_Date
{
	// Переменная для кеширования
	protected static $_month = NULL;

	/**
	 * Возвращаем название месяца на русском соответствующее номеру месяца
	 *
	 * @param      $month  Номер месяца от 01 до 12
	 * @param bool $sufix
	 *
	 * @return mixed
	 */
	public static function get_month_full($month, $sufix = true)
	{
		if (self::$_month === null)
		{
			self::$_month = array(
				'01' => 'Январ'   . ($sufix ? 'я' : 'ь'),
				'02' => 'Феврал'  . ($sufix ? 'я' : 'ь'),
				'03' => 'Март'    . ($sufix ? 'а' : '' ),
				'04' => 'Апрел'   . ($sufix ? 'я' : '' ),
				'05' => 'Ма'      . ($sufix ? 'я' : 'й'),
				'06' => 'Июн'     . ($sufix ? 'я' : 'ь'),
				'07' => 'Июл'     . ($sufix ? 'я' : 'ь'),
				'08' => 'Август'  . ($sufix ? 'а' : '' ),
				'09' => 'Сентябр' . ($sufix ? 'я' : 'ь'),
				'10' => 'Октябр'  . ($sufix ? 'я' : 'ь'),
				'11' => 'Ноябр'   . ($sufix ? 'я' : 'ь'),
				'12' => 'Декабр'  . ($sufix ? 'я' : 'ь'),
			);
		}

		return self::$_month[$month];
	}

	/**
	 * Возвращаем дату в формате: `06 Января 2012`
	 * (PHP 5 >= 5.2.0)
	 *
	 * @param $date_string  Строка вида `YYYY-MM-DD HH:MM:SS`
	 *
	 * @return string
	 */
	public static function d_m_Y($date_string)
	{
		$date = new DateTime($date_string);

		return $date->format('d') . ' ' . Date::get_month_full($date->format('m')) . ' ' . $date->format('Y');
	}


//======================================================================================================================
//  Для форматирования даты и времени заданного в секундах (метка времени Unix)

	public  static $config_name = 'app';
	private static $_app_config = NULL;

	/**
	 * Возвращает время в формате из конфига
	 *
	 * @param null $timestamp
	 * @return string
	 */
	static function format_time($timestamp = NULL)
	{
		return self::_get_format('format_time', $timestamp);
	}

	/**
	 * Возвращает дату в формате из конфига
	 *
	 * @param null $timestamp
	 * @return string
	 */
	static function format_date($timestamp = NULL)
	{
		return self::_get_format('format_date', $timestamp);
	}

	/**
	 * Возвращает дату и время в формате из конфига
	 *
	 * @param null $timestamp
	 * @return string
	 */
	static function format_date_time($timestamp = NULL)
	{
		return self::_get_format('format_date_time', $timestamp);
	}

	/**
	 * Возвращаем отформатированное по конфигу значение
	 *
	 * @param $key_format
	 * @param $timestamp
	 *
	 * @return string
	 * @throws Kohana_Exception
	 */
	private static function _get_format($key_format, $timestamp)
	{
		if (self::$_app_config === NULL)
		{
			if ( ! Kohana::find_file('config', self::$config_name))
			{
				throw new Kohana_Exception('Configuration file not exists');
			}

			self::$_app_config = Kohana::$config->load(self::$config_name);
		}

		if ($timestamp === NULL)
			$timestamp = time();

		return date(self::$_app_config[$key_format], $timestamp);
	}
}

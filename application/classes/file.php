<?php defined('SYSPATH') or die('No direct script access.');

class File extends Kohana_File
{
	/**
	 * Создаем папку
	 *
	 * @static
	 * @param $path  - полный путь к папке
	 * @return mixed - путь к папке
	 */
	static function create_dir($path)
	{
		if ( ! is_dir($path))
		{
			mkdir($path, 0777, TRUE);
			chmod($path, 0777);
		}

		return $path;
	}

	/**
	 * Удаляем указанную папку со всеми вложенными папками и файлами
	 *
	 * @static
	 * @param $dir
	 */
	static function remove_dir_rec($dir)
	{
		if ($objs = glob($dir . '/*'))
		{
			foreach($objs as $obj)
			{
				is_dir($obj) ? self::remove_dir_rec($obj) : @unlink($obj);
			}
		}
		@rmdir($dir);
	}

	/**
	 * Удаляем файл(ы)
	 *
	 * @param $full_path
	 *
	 * @return bool
	 */
	static function remove($full_path)
	{
		// Если массив файлов
		if (is_array($full_path))
		{
			// Перебираем все
			foreach ($full_path as $path)
			{
				// Если файл существует и доступен для записи (удаления)
				if (is_file($path) AND is_writable($path))
				{
					// Удаляем файл
					unlink($path);
				}
			}
		}

		// Если один файл
		else
		{
			// Если файл существует и доступен для записи (удаления)
			if (is_file($full_path) AND is_writable($full_path))
			{
				// Удаляем файл
				unlink($full_path);

				return true;
			}
		}
	}
}
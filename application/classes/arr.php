<?php defined('SYSPATH') or die('No direct script access.');

class Arr extends Kohana_Arr
{
	/**
	 * Create array from object
	 *
	 * @param   mixed   $obj  Database MySQL Result Object
	 * @access  public
	 * @return  array
	 */
	public static function set_id_array($obj)
	{
		$array = array();

		foreach ($obj as $a => $b)
			$array[$a] = $b;

		return $array;
	}


	/**
	 * Массив ids
	 * Для использования в условиях where in array()
	 *
	 * @param $obj
	 * @return array
	 */
	public static function get_array_ids($obj)
	{
		$array = array();

		foreach ($obj as $o)
			$array[] = $o->id;

		return $array;
	}
}
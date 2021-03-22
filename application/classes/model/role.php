<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Role extends Model_Auth_Role
{
	// При изменениях в БД здесь тоже правильно заполнить
	// (можно закомментировать до продакшена
	protected $_table_columns = array(
		'id'          => array('type' => 'int'),
		'name'        => array('type' => 'string'),
		'description' => array('type' => 'string'),
	);
}
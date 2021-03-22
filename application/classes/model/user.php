<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User
{
	// При изменениях в БД здесь тоже правильно заполнить
	// (можно закомментировать до продакшена
	protected $_table_columns = array(
		'id'         => array('type' => 'int'),
		'email'      => array('type' => 'string'),
		'username'   => array('type' => 'string'),
		'password'   => array('type' => 'string'),
		'logins'     => array('type' => 'int'),
		'last_login' => array('type' => 'int'),
	);
}
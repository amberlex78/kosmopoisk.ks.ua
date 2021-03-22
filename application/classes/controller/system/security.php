<?php defined('SYSPATH') or die('No direct script access.');
/*
 * То что касается достпа к страницам
 *
 * Пока ничего нет, кроме админа и пользователя
 */
class Controller_System_Security extends Controller_System_Controller
{
	// Пользователь
	public $user;

	// Админ или нет
	public $is_admin;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Before action
	 */
	public function before()
	{
		parent::before();

		$this->user     = Auth::instance()->get_user();
		$this->is_admin = Auth::instance()->logged_in('admin');
	}
}
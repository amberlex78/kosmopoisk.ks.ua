<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Auth extends Controller_System_Template
{
	public $template = 'backend/layouts/v_auth';

	/**
	 * Вход в админку
	 */
	public function action_login()
	{
		// Если пришли данные POST
		if ($this->is_post())
		{
			// Если не залогинились
			if ( ! Auth::instance()->login(
				$this->request->post('username'),
				$this->request->post('password'),
				(bool) $this->request->post('remember')
			))

				// Сообщение
				$this->set_message('error', 'users.error.auth');
		}

		// Если залогиненный юзер - админ, направляем его в админку
		if (Auth::instance()->logged_in('admin'))
			$this->request->redirect(ADMIN . 'publications/articles');

		// Если по этому адресу попал залогиненный юзер - 404
		if (Auth::instance()->logged_in())
			throw new HTTP_Exception_404();

		// Форма авторизации
		$this->title = __('users.authorization');
		$this->block_center = View::factory('backend/auth/v_login');
	}


	/**
	 * Выход из админки
	 */
	public function action_logout()
	{
		if (Auth::instance()->logout())
			$this->request->redirect(ADMIN . '/login');
	}


	/**
	 * Создание админа
	 *
	 * 1. Изменить в роуте `backend_auth`
	 *    array('action' => 'login|logout') на
	 *    array('action' => 'login|logout|createadmin')
	 *
	 * 2. Создать админа по ссылке http://skeleton/admin/createadmin
	 *
	 * 3. Изменить роут обратно
	 */
	public function action_createadmin()
	{
		$user = ORM::factory('user');
		$user->values(array(
			'username' => 'yarkru',
			'email'    => 'yarkru@gmail.com',
			'password' => 're5yarkru0deen',
		));
		$user->save();
		$user->add('roles', ORM::factory('role', array('name' => 'login')));
		$user->add('roles', ORM::factory('role', array('name' => 'admin')));

		$this->set_message('success', 'users.admin_created');
		$this->request->redirect(ADMIN . '/login');
	}
}

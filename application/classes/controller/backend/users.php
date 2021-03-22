<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Главная страница
 */
class Controller_Backend_Users extends Controller_Backend
{
	// Название блока меню
	public $block_title = 'users.heading';


	/**
	 * Редактирование профиля админа
	 */
	public function action_admin()
	{
		$this->action_edit();
	}


	/**
	 * Редактирование профиля пользователя
	 */
	public function action_edit()
	{
		// Если нет id - считаем, что это профиль админа
		$o_user = ORM::factory('user', (int) $this->request->param('id', $this->user->id));

		if ( ! $o_user->loaded())
			throw new HTTP_Exception_404();

		$user_role = ($o_user->id == $this->user->id) ? 'admin' : 'user';

		if ($this->is_post())
		{
			// Валидация пароля
			$pw = Validation::factory($_POST);
			$pw->rule('password', 'min_length', array(':value', 6));
			$pw->rule('password', 'max_length', array(':value', 64));

			// Данные из формы
			$data_user = Arr::extract($_POST, array('username', 'password'));
			$data_user['password'] = trim($data_user['password']);
			$data_user['username'] = trim($data_user['username']);

			// Если пароль пустой - убираем его вообще
			// (связано с валидацией и фильтрами в Model_Auth_User)
			if ($data_user['password'] == '')
				unset($data_user['password']);

			if ($data_user['username'] == '')
				unset($data_user['username']);

			// Данные для сохранения
			$o_user->values($data_user);

			try {
				// Сохраняем данные пользователя
				$o_user->save($pw);

				// Сообщение, что все нормально
				$this->set_message('success', 'app.message.ok_edited');

				// Если пользователь админ
				if ($user_role == 'admin')
				{
					$this->request->redirect(ADMIN . '/users/admin');
				}
				else
				{
					$this->request->redirect(ADMIN . '/users');
				}
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->set_message('error', 'app.message.error_saved');
				$errors = $e->errors('validation');
			}
		}

		// Подготовка шаблона
		$this->title = __('users.profile_edit');
		$this->block_center = View::factory('backend/users/v_edit', array('o_user' => $o_user))
			->bind('errors', $errors);
	}
}

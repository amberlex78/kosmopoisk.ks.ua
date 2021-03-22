<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Настройки сайта
 */
class Controller_Backend_Settings extends Controller_Backend {

	// Название блока меню
	public $block_title = 'settings.heading';

	/**
	 * Глобальные настройки сайта
	 */
	public function action_index()
	{
		// Поля настроек
		$for_extract = array(
			'sitename',
			'siteslogan',
			'sitecopy',
			'autograph',
			'meta_d',
			'meta_k',
			'email',
		);

		// Если пришли данные POST
		if ($this->is_post())
		{
			// Фильтруем, валидируем
			$post = Validation::factory(array_map('trim', array_map('strip_tags', $_POST)))

				->rule('sitename', 'not_empty')
				->rule('email', 'email');

			$post->labels(array(
				'sitename' => 'settings.sitename',
				'email'    => 'settings.email',
			));

			// Если валидация пройдена
			if ($post->check())
			{
				// Обновляем данные
				foreach ($for_extract as $field)
					$this->config[$field] = $post[$field];

				$this->config->save();

				$this->set_message('success', 'settings.message.ok.save');
				$this->request->redirect(ADMIN . '/settings');
			}
			else
			{
				$this->set_message('error', 'app.message.error_saved');

				// Данныне для шаблона
				$errors = $post->errors('validation');
				$data = Arr::extract($_POST, $for_extract);
			}
		}

		// Иначе берем из конфига
		else
			$data = Arr::extract($this->config->as_array(), $for_extract);


		// Подготовка шаблона
		$this->title = __('settings.manager_global');
		$this->block_center = View::factory('backend/settings/v_index', array('data' => $data))
			->bind('errors', $errors);
	}
}
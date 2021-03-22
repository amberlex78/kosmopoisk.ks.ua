<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Error extends Controller_Frontend
{
	// Указать другой layout
	//public $template = 'frontend/layouts/v_index';

	public function before()
	{
		parent::before();

		// Получаем статус ошибки
		$status = (int) $this->request->action();

		// Назначаем шаблон
		$this->block_center = View::factory('errors/' . $status);

		// Получаем сообщение об ошибке
		if (Request::$initial !== Request::$current)
		{
			$message = rawurldecode($this->request->param('message'));

			if ($message)
			{
				$this->template->message = $message;
			}
		}
		else
		{
			$this->request->action(404);
		}
		$this->response->status($status);
	}

	public function action_403()
	{
		$this->title = __('app.message.error_403');
	}

	public function action_404()
	{
		$this->title = __('app.message.error_404');
	}

	public function action_500()
	{
		$this->title = __('app.message.error_500');
	}

	public function action_503()
	{
		$this->title = __('app.message.error_503');
	}
}

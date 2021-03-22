<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер Backend
 */
class Controller_Backend extends Controller_System_Template
{
	// Базовый шаблон для backend
	public $template = 'backend/layouts/v_index';

	// Блок меню (для свертывания/развертывания меню)
	public $block = 'dashboard';


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Before action
	 */
	public function before()
	{
		parent::before();

		// Если не админ
		if ( ! $this->is_admin)
			$this->request->redirect(ADMIN . '/login');
	}

	/**
	 * After action
	 */
	public function after()
	{
		// Название блока - Название страницы
		$this->template->legend = __($this->block_title) . SEPARATOR . $this->title;

		// Шаблон блоков меню слева
		$this->block_left = View::factory(
			'backend/v_navigation',
			array(
				'blocks'          => Kohana::$config->load('backend.blocks'),
				'curr_module'     => $this->block,
				'curr_controller' => $this->request->controller(),
				'curr_action'     => $this->request->action(),
			)
		);

		parent::after();
	}
}
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Dashboard extends Controller_Backend
{
	// К какому блоку меню относится (для свертывания/развертывания меню)
	public $block = 'dashboard';

	// Название блока меню
	public $block_title = 'app.caption.dashboard';


	public function action_index()
	{
		$info = array(
			'user_agent' => Request::$user_agent,
			'user_ip'    => Request::$client_ip,
			'user_lang'  => Request::accept_lang(),
			'phpversion' => phpversion(),
		);

		$this->title = __('app.caption.main');
		$this->block_center = View::factory('backend/dashboard/v_index',
			array(
				'info' => $info,
			)
		);
	}
}

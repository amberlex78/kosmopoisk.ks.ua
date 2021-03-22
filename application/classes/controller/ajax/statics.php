<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Статические страницы
 */
class Controller_Ajax_Statics extends Controller_System_Ajax
{
	/**
	 * Изменить статус страницы
	 */
	public function action_change_status()
	{
		// Если не админ
		if ( ! $this->is_admin)
			throw new HTTP_Exception_404();

		$obj = ORM::factory('static', (int) Arr::get($_POST, 'id'));

		if ($obj->loaded())
		{
			$obj->status = $obj->status ? 0 : 1;
			$obj->save();

			$this->data['params']['status'] = (bool) $obj->status;

			$this->data['success'] = TRUE;
		}

		$this->response->body(json_encode($this->data));
	}
}
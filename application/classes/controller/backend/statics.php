<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер статических страниц
 */
class Controller_Backend_Statics extends Controller_Backend
{
	// К какому блоку меню относится (для свертывания/развертывания меню)
	public $block = 'statics';

	// Название блока меню
	public $block_title = 'statics.heading';


	/**
	 * Статические страницы (список)
	 */
	public function action_pages()
	{
		$o_static = ORM::factory('static')->reset(FALSE);

		$this->title = __('statics.manager_pages');
		$this->block_center = View::factory('backend/statics/v_pages',
			array(
				'amount'  => $o_static->count_all(),
				'o_pages' => $o_static->find_all(),
			));
	}

	/**
	 * Добавить статическую страницу
	 */
	public function action_add()
	{
		$o_page = ORM::factory('static');

		$this->title    = __('statics.add');
		$this->_message = __('statics.added');
		$this->_save_static_page($o_page);
	}

	/**
	 * Редактировать статическую страницу
	 */
	public function action_edit()
	{
		$o_page = ORM::factory('static', (int) $this->request->param('id'));

		if ( ! $o_page->loaded())
			throw new HTTP_Exception_404();

		$this->title    = __('statics.edit');
		$this->_message = __('statics.edited');
		$this->_save_static_page($o_page);
	}

	/**
	 * Сохраняем статическую страницу
	 *
	 * @param $o_page
	 */
	public function _save_static_page($o_page)
	{
		if ($this->is_post())
		{
			$o_page->values($_POST);

			try
			{
				// Если название для пункта меню для категории пустое
				if (trim(Arr::get($_POST, 'title_menu')) == '')
				{
					// Берем из названия категории
					$o_page->title_menu = Arr::get($_POST, 'title');
				}

				$o_page->save();

				$this->set_message('success', $this->_message);
				$this->request->redirect(ADMIN . '/statics/pages');
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->set_message('error', 'app.message.error_saved');
				$errors = $e->errors('validation');
			}
		}

		$this->block_center = View::factory('backend/statics/v_form', array('data' => $o_page))
			->bind('errors', $errors);
	}

	/**
	 * Удаляем статическую страницу
	 */
	public function action_delete()
	{
		$obj = ORM::factory('static', $this->request->param('id'));

		// Если страница загружена и не запрещена к удалению
		if ($obj->loaded() AND $obj->allow_delete)
		{
			$obj->delete();
			$this->set_message('success', 'statics.deleted');
		}
		else
			$this->set_message('error', 'app.message.error_deleted');

		$this->request->redirect(ADMIN . '/statics/pages');
	}
}

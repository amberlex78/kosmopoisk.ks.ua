<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер Frontend
 */
class Controller_Frontend extends Controller_System_Template
{
	/**
	 * Before action
	 */
	public function before()
	{
		parent::before();

		$this->_set_menu_for_top();
		$this->_set_menu_for_categories();
		//$this->_set_tags();
		$this->_set_social();
	}


	/**
	 * Статические страницы для верхнего меню
	 */
	private function _set_menu_for_top()
	{
		// Статические страницы
		$static_pages = DB::select('slug', 'icon_menu', 'title_menu', 'status')
			->from('statics')
			->order_by('sorter')
			->as_object();

		// Если не админ - учитываем статус страницы
		if ( ! $this->is_admin)
			$static_pages->where('status', '=', 1);

		// Устанавливаем глобальную переменную
		$this->template->set_global('static_pages', $static_pages->execute());
	}

	/**
	 * Статические страницы для меню категорий
	 */
	private function _set_menu_for_categories()
	{
		// Меню категорий - Немецкий
		$main_menus = DB::select('slug', 'title_menu', 'status')
			->where('parent_id', '!=', 0)
			->from('publications_categories')
			->order_by('sorter')
			->as_object();

		// Если не админ - учитываем статус страницы
		if ( ! $this->is_admin)
			$main_menus->where('status', '=', 1);

		// Шаблон
		$this->block_left['navigation'] = View::factory(
			'frontend/leftside/v_navigation',
			array(
				'main_menus' => $main_menus->execute(),
			)
		);
	}

	/**
	 * Получаем облако тегов
	 */
	private function _set_tags()
	{
		// Выбираем
		$o_tags = DB::select(
				'publications_tags.name',
				'publications_tags.slug',
				array('COUNT("publications_articles_tags.tag_id")', 'posts_count')
			)
			->from('publications_articles_tags')
			->join('publications_tags')
			->on('publications_articles_tags.tag_id', '=', 'publications_tags.id')
			->order_by('name')
			->group_by('publications_tags.id')
			->execute()
			->as_array();

		// Шаблон
		$this->block_left['tags'] = View::factory(
			'frontend/leftside/v_tags',
			array(
				'o_tags' => $o_tags,
			)
		);
	}

	private function _set_social()
	{
		// Шаблон
		$this->block_left['social'] = View::factory('frontend/leftside/v_social');
	}
}
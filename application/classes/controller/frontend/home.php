<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Главная страница
 */
class Controller_Frontend_Home extends Controller_Frontend
{
	/**
	 * Вывод главной страницы
	 * (в БД ее id всегда должен быть 1)
	 */
	public function action_index()
	{
		$o_page = ORM::factory('static', 1);

		if ( ! $o_page->loaded())
			throw new HTTP_Exception_404();


		// Статьи
		$o_last_articles = ORM::factory('publications_article');

		// Если не админ
		if ( ! $this->is_admin)
		{
			// Условие только на включенные статьи
			$o_last_articles->where('publications_article.status', '=', 1);
		}

		// Шаблон - постраничка
		$pagination = Pagination::factory(array(
			'total_items'    => $o_last_articles->reset(FALSE)->count_all(),
			'items_per_page' => $this->config['publications']['per_page_home'],
			'view'           => 'frontend/v_pagination'
		));

		// meta
		$this->title = $o_page->meta_t == '' ? $o_page->title : $o_page->meta_t ;
		$this->description = $o_page->meta_d;
		$this->keywords = $o_page->meta_k;

		// Шаблон
		$this->block_center = View::factory('frontend/home/v_index',
			array(
				'o_page' => $o_page,
				'o_last_articles' =>
					View::factory('frontend/home/v_last_articles',
						array(
							'pagination' => $pagination,
							'o_articles' => $o_last_articles
								->with('category')
								->limit($pagination->items_per_page)
								->offset($pagination->offset)
								->order_by('created', 'desc')
								->find_all(),
						))
			));
	}
}

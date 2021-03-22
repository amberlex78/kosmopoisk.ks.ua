<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер публикаций (категории и статьи)
 */
class Controller_Frontend_Publications extends Controller_Frontend
{
	/**
	 * Категория
	 */
	public function action_category()
	{
		// Ссылка категории
		$slug = $this->request->param('slug');

		// Получаем категорию
		$o_category = ORM::factory('publications_category')->where('slug', '=', $slug);

		// Если не админ
		if ( ! $this->is_admin)
		{
			// Только на включенные категории
			$o_category->where('status', '=', 1);
		}

		// Находим категорию
		$o_category->find();

		// Если не найдена - 404
		if ( ! $o_category->loaded())
			throw new HTTP_Exception_404();

		// Получаем статьи текущей категории
		$o_articles = $o_category->articles;

		// Если не админ
		if ( ! $this->is_admin)
		{
			// Только на включенные статьи
			$o_articles->where('status', '=', 1);
		}


		// Шаблон - постраничка
		$pagination = Pagination::factory(array(
			'total_items'    => $o_articles->reset(FALSE)->count_all(),
			'items_per_page' => $this->config['publications']['per_page_frontend'],
			'view'           => 'frontend/v_pagination'
		));

		// Используется для подсветки меню
		$this->slug = $o_category->slug;

		// Шаблон
		$this->title = $o_category->meta_t == '' ? $o_category->title : $o_category->meta_t ;
		$this->block_center = View::factory('frontend/publications/v_category',
			array(
				'o_category' => $o_category,
				'pagination' => $pagination,
				'o_articles' => $o_articles
					->limit($pagination->items_per_page)
					->offset($pagination->offset)
					->order_by('created', 'DESC')
					->find_all(),
			));
	}

	/**
	 * Статья
	 */
	public function action_article()
	{
		// Ссылка категории
		$slug = $this->request->param('slug');

		// Получаем страницу
		$o_article = ORM::factory('publications_article')->where('slug', '=', $slug);

		// Если не админ
		if ( ! $this->is_admin)
		{
			// Условие только включенные страницы
			$o_article->where('status', '=', 1);
		}

		// Находим страницу
		$o_article->find();

		// Если не найдена - 404
		if ( ! $o_article->loaded())
			throw new HTTP_Exception_404();


		// Используется для подсветки меню
		$this->slug = $o_article->category->slug;

		$o_article->category->parent_id;

		// Шаблон
		$this->title        = $o_article->meta_t == '' ? $o_article->title : $o_article->meta_t ;
		$this->description  = $o_article->meta_d;
		$this->keywords     = $o_article->meta_k;
		$this->block_center = View::factory('frontend/publications/v_article',
			array(
				'o_article' => $o_article,
				'tags'      => $o_article->tags->find_all(),
			));
	}
}
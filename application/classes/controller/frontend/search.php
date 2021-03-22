<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер поиска по сайту
 */
class Controller_Frontend_Search extends Controller_Frontend
{
	/**
	 * Поиск на сайте
	 */
	public function action_index()
	{
		// Параметр
		$search_string = $this->request->param('tag');

		// Если есть параметр - ищем по тегам
		if ($search_string)
		{
			$type_search = 'tag';

			$this->title = __('app.caption.search_result_tag');

			// Выбрать тег
			$o_tag = ORM::factory('publications_tag', array('slug' => $search_string));

			// Если есть запись
			if ($o_tag->loaded())
			{
				// Имя тега
				$search_string = $o_tag->name;

				// Статьи с этим тегом
				$o_articles = $o_tag->articles;

				// Если не админ
				if ( ! $this->is_admin)
				{
					// Только на включенные статьи
					$o_articles->where('publications_article.status', '=', 1);
				}

				// Количество записей
				$amount_records = $o_articles->reset(FALSE)->count_all();

				// Шаблон - постраничка
				$pagination = Pagination::factory(array(
					'total_items'    => $amount_records,
					'items_per_page' => $this->config['publications']['per_page_home'],
					'view'           => 'frontend/v_pagination'
				));


				// Шаблон
				$v_result =	View::factory('frontend/home/v_last_articles',
					array(
						'pagination' => $pagination,
						'o_articles' => $o_articles
							->with('category')
							->limit($pagination->items_per_page)
							->offset($pagination->offset)
							->order_by('created', 'desc')
							->find_all(),
					));
			}
			else
				$this->set_message('error', 'app.message.error_search');
		}

		// Если нет патраметра `tag`
		else
		{
			$type_search = 'text';

			$this->title = __('app.caption.search_result');

			// Пришли данные POST
			if ($this->is_post())
			{
				// Строка поиска
				$search_string = trim(strip_tags(Arr::get($_POST, 'search_string')));

				// Обрезаем до 32 символов
				$search_string = UTF8::substr($search_string, 0, 32);

				// Если строка больше 2-х символов - ищем
				if (UTF8::strlen($search_string) > 2)
				{
					// Стаьи
					$o_articles = ORM::factory('publications_article')
						->where('publications_article.title', 'like', "%$search_string%")
						->or_where('publications_article.preview', 'like', "%$search_string%");

					// Если не админ
					if ( ! $this->is_admin)
					{
						// Только на включенные статьи
						$o_articles->where('publications_article.status', '=', 1);
					}

					// Количество записей
					$amount_records = $o_articles->reset(FALSE)->count_all();

					// Шаблон - постраничка
					$pagination = Pagination::factory(array(
						'total_items'    => $amount_records,
						'items_per_page' => $this->config['publications']['per_page_home'],
						'view'           => 'frontend/v_pagination'
					));

					// Шаблон
					$v_result =	View::factory('frontend/home/v_last_articles',
						array(
							'pagination' => $pagination,
							'o_articles' => $o_articles
								->with('category')
								->limit($pagination->items_per_page)
								->offset($pagination->offset)
								->order_by('created', 'desc')
								->find_all(),
						));

					// Если ничего не найдено
					if ($amount_records < 1)
						$this->set_message('error', 'app.message.error_search');
				}
				else
					$this->set_message('error', 'app.message.error_search_num');

				//$this->request->redirect('search');
			}
		}


		// Общий шаблон
		$this->block_center = View::factory('frontend/search/v_index', array('title' => $this->title))
			->bind('v_result', $v_result)
			->bind('type_search', $type_search)
			->bind('search_string', $search_string)
			->bind('amount_records', $amount_records);
	}
}

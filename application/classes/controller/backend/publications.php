<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер публикаций (категории и статьи)
 */
class Controller_Backend_Publications extends Controller_Backend
{
	// К какому блоку меню относится (для свертывания/развертывания меню)
	public $block = 'publications';

	// Название блока меню
	public $block_title = 'publications.heading';


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Управление категориями

	/**
	 * Категории (список)
	 */
	public function action_categories()
	{
		// Создать корневую категорию
		// У корневой категории должны быть: id = 0, parent_id = 1
		//$cat = ORM::factory('publications_category');
		//$cat->title = 'ROOT';
		//$cat->make_root();

		$id = (int) $this->request->param('id', 1);

		// Текущая категория (родитель)
		$o_pcategory = ORM::factory('publications_category', $id);

		// Если нет категории - 404
		if ( ! $o_pcategory->loaded())
			throw new HTTP_Exception_404;

		// Хлебные крошки
		$breadcrumbs = $o_pcategory->parents(true, true);

		// Подкатегории
		$o_categories = ORM::factory('publications_category')
			->where('parent_id', '=', $id)
			->order_by('sorter')
			->reset(FALSE);

		// Шаблоны
		$this->title = __('publications.manager_categories');
		$this->block_center = View::factory(
			'backend/publications/v_categories',
			array(
				'o_pcategory'       => $o_pcategory,
				'breadcrumbs'       => View::factory('backend/publications/v_breadcrumbs', array('breadcrumbs' => $breadcrumbs, 'is_anchor' => false)),
				'o_categories'      => $o_categories->find_all(),
				'num_of_categories' => $o_categories->count_all(),
			));

	}

	/**
	 * Добавить категорию
	 */
	public function action_add_category()
	{
		$id = (int) $this->request->param('id');

		// Текущая категория (родитель)
		$o_pcategory = ORM::factory('publications_category', $id);

		// Если нет категории - 404
		if ( ! $o_pcategory->loaded())
			throw new HTTP_Exception_404();

		// Хлебные крошки
		$breadcrumbs = $o_pcategory->parents(true, true);

		$o_category = ORM::factory('publications_category');

		// Если POST запрос
		if ($this->is_post())
		{
			$o_category->values($_POST);

			// Если название для пункта меню для категории пустое
			if (trim(Arr::get($_POST, 'title_menu')) == '')
			{
				// Берем из названия категории
				$o_category->title_menu = Arr::get($_POST, 'title');
			}

			try
			{
				// Добавляем категорию
				$o_category->insert_as_last_child($o_pcategory->id);

				$this->set_message('success', 'publications.category.added');
				$this->request->redirect(ADMIN . '/publications/categories/' . $id);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->set_message('error', 'app.message.error_saved');
				$errors = $e->errors('validation');
			}
		}

		// Шаблоны
		$this->title = __('publications.category.add');
		$this->block_center = View::factory('backend/publications/v_form_category',
			array(
				'breadcrumbs' => View::factory('backend/publications/v_breadcrumbs', array('breadcrumbs' => $breadcrumbs, 'is_anchor' => true)),
				'data'        => $o_category,
			))
			->bind('errors', $errors);
	}

	/**
	 * Добавить категорию
	 */
	public function action_edit_category()
	{
		$id = (int) $this->request->param('id');

		// Текущая категория (родитель)
		$o_category = ORM::factory('publications_category', $id);

		// Если нет категории - 404
		if ( ! $o_category->loaded())
			throw new HTTP_Exception_404();

		// Хлебные крошки
		$breadcrumbs = $o_category->parents(true, false);

		// Если POST запрос
		if ($this->is_post())
		{
			$o_category->values($_POST);

			try
			{
				// Если название для пункта меню для категории пустое
				if (trim(Arr::get($_POST, 'title_menu')) == '')
				{
					// Берем из названия категории
					$o_category->title_menu = Arr::get($_POST, 'title');
				}

				// Сохраняем категорию
				$o_category->save();

				$this->set_message('success', 'publications.category.edited');
				$this->request->redirect(ADMIN . '/publications/categories/' . $o_category->parent_id);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->set_message('error', 'app.message.error_saved');
				$errors = $e->errors('validation');
			}
		}

		// Шаблоны
		$this->title = __('publications.category.edit');
		$this->block_center = View::factory('backend/publications/v_form_category',
			array(
				'breadcrumbs' => View::factory('backend/publications/v_breadcrumbs', array('breadcrumbs' => $breadcrumbs, 'is_anchor' => true)),
				'data'        => $o_category,
			))
			->bind('errors', $errors);
	}

	/**
	 * Удаление категории (со всеми вложенными категориями и статьями)
	 */
	public function action_delete_category()
	{
		$id = (int) $this->request->param('id');

		// Объект для удаления
		$obj = ORM::factory('publications_category', $id);

		// Если нет категории или ROOT
		if ( ! $obj->loaded() OR $obj->parent_id == 0)
			throw new HTTP_Exception_404();

		// Удаляем
		$obj->delete();

		$this->set_message('success', 'publications.category.deleted');
		$this->request->redirect($this->request->referrer());
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Управление статьями

	/**
	 * Статьи (список)
	 */
	public function action_articles()
	{
		$cid = (int) $this->request->param('id');

		// Если в категории - будем выводить статьи этой категории
		if ($cid)
		{
			// Текущая категория
			$obj = ORM::factory('publications_category', $cid);

			// Если ROOT - 404
			if ($cid == 1)
				throw new HTTP_Exception_404();

			// Если нет категории - 404
			if ( ! $obj->loaded())
				throw new HTTP_Exception_404();

			// Хлебные крошки
			$breadcrumbs = View::factory('backend/publications/v_breadcrumbs',
				array('breadcrumbs' => $obj->parents(false, true),
					  'is_anchor'   => false
				));

			// Все статьи этой категории
			$obj = $obj->articles;
		}

		// Будем выводить все статьи
		else
		{
			// Все статьи с категориями
			$obj = ORM::factory('publications_article')->with('category');
		}

		// Шаблон - постраничка
		$pagination = Pagination::factory(array(
			'total_items'    => $obj->reset(FALSE)->count_all(),
			'items_per_page' => $this->config['publications']['per_page_backend'],
			'view'           => 'backend/v_pagination'
		));

		// Шаблон
		$this->title = __('publications.manager_articles');
		$this->block_center = View::factory(
			'backend/publications/v_articles',
			array(
				'cid' => $cid,
				'pagination'  => $pagination,
				'o_articles'  => $obj
					->limit($pagination->items_per_page)
					->offset($pagination->offset)
					->order_by('created', 'DESC')
					->find_all(),
			))
			->bind('breadcrumbs', $breadcrumbs);
	}

	/**
	 * Добавить статью
	 */
	public function action_add_article()
	{
		// Режим добавления
		$this->session->set('flag_article_action', 'add');

		$cid = $this->request->post('category_id')
			? (int) $this->request->post('category_id')
			: (int) $this->request->param('id');

		// Если id больше id ROOT - принимаем
		$cid = $cid > 1 ? $cid : 0;

		$o_article = ORM::factory('publications_article');

		// Получаем сторку тегов
		$tags = Arr::get($_POST, 'tags');

		// Если POST запрос
		if ($this->is_post())
		{
			if (trim(Arr::get($_POST, 'meta_t')) == '')
				$_POST['meta_t'] = Arr::get($_POST, 'title');

			if (trim(Arr::get($_POST, 'meta_d')) == '')
				$_POST['meta_d'] = trim(strip_tags(Arr::get($_POST, 'preview')));

			if (trim(Arr::get($_POST, 'meta_k')) == '')
				$_POST['meta_k'] = Arr::get($_POST, 'title');

			// Поля для записиси
			$o_article->values($_POST);

			// Имя файла загруженного изображения
			$fimage = $this->session->get('uploaded_image_add');

			// Для записи в базу
			$o_article->fimage = $fimage;

			try
			{
				// Сохраняем статью (внешняя валидация для проверки выбранной категории)
				$o_article->save(Model_Publications_Article::is_category());

				//======================================================================================================
				// Получаем массив ids тегов
				$tids = Model_Publications_Tag::add_tags($o_article->id, $tags);
				// Если есть теги
				if ($tags)
				{
					// Добавляем их в связующую таблицу
					$o_article->add('tags', $tids);
				}
				//======================================================================================================

				$this->session->set('uploaded_image_add', '');

				$this->set_message('success', 'publications.article.added');
				$this->request->redirect(ADMIN . '/publications/articles/' . $cid);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->set_message('error', 'app.message.error_saved');
				$errors = $e->errors('validation');
			}
		}

		// Шаблон
		$this->title = __('publications.article.add');
		$this->block_center = View::factory('backend/publications/v_form_article',
			array(
				'cid'  => $cid,
				'data' => $o_article,
				'categories' => App_Tree::get_array_for_select('publications_categories', __('publications.category.not_selected')),
			))
			->bind('tags', $tags)
			->bind('errors', $errors);
	}

	/**
	 * Редактировать статью
	 */
	public function action_edit_article()
	{
		$id = (int) $this->request->param('id');

		// Строка тегов
		$tags = Arr::get($_POST, 'tags');

		// Редактируемая статья
		$o_article = ORM::factory('publications_article', $id);

		// Если нет статьи - 404
		if ( ! $o_article->loaded())
			throw new HTTP_Exception_404();

		// Режим редактирования
		$this->session->set('flag_article_action', 'edit');
		$this->session->set('flag_article_id', $o_article->id);

		// Если POST запрос
		if ($this->is_post())
		{
			if (trim(Arr::get($_POST, 'meta_t')) == '')
				$_POST['meta_t'] = Arr::get($_POST, 'title');

			if (trim(Arr::get($_POST, 'meta_d')) == '')
				$_POST['meta_d'] = trim(strip_tags(Arr::get($_POST, 'preview')));

			if (trim(Arr::get($_POST, 'meta_k')) == '')
				$_POST['meta_k'] = Arr::get($_POST, 'title');

			// Поля для записиси
			$o_article->values($_POST);

			try
			{
				// Сохраняем статью (external валидация для проверки выбранной категории)
				$o_article->save(Model_Publications_Article::is_category());

				// Сохраняем теги и получаем массив ids тегов
				$tids = Model_Publications_Tag::add_tags($o_article->id, $tags);

				// Если есть теги
				if ($tags)
				{
					// Добавляем их в связующую таблицу
					$o_article->add('tags', $tids);
				}

				$this->session->set('uploaded_image_edit', '');

				$this->set_message('success', 'publications.article.edited');
				$this->request->redirect(ADMIN . '/publications/articles/' . $o_article->category_id);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->set_message('error', 'app.message.error_saved');
				$errors = $e->errors('validation');
			}
		}
		else
		{
			// Получаем теги татьи
			$o_tags = $o_article->tags->find_all();

			// Перебираем
			foreach ($o_tags as $o_tag)
			{
				// Формируем сторку для input text
				$tags .= $o_tag->name . ', ';
			}

			// Убираем последнюю запятую
			$tags = rtrim($tags, ', ');
		}


		// Шаблон
		$this->title = __('publications.article.edit');
		$this->block_center = View::factory('backend/publications/v_form_article',
			array(
				'cid'  => $o_article->category_id,
				'data' => $o_article,
				'categories' => App_Tree::get_array_for_select('publications_categories', __('publications.category.not_selected')),
			))
			->bind('tags', $tags)
			->bind('errors', $errors);
	}

	/**
	 * Удаление статьи
	 */
	public function action_delete_article()
	{
		$id = (int) $this->request->param('id');

		// Объект для удаления
		$obj = ORM::factory('publications_article', $id);

		// Если нет статьи
		if ( ! $obj->loaded())
			throw new HTTP_Exception_404();

		// Удаляем папку статьи со всем содержимым
		File::remove(IMG_PUBLICATIONS_DIR . $obj->fimage);

		// Удаляем
		$obj->delete();

		$this->set_message('success', 'publications.article.deleted');
		$this->request->redirect($this->request->referrer());
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Настройки Publications

	/**
	 * Настройки модуля
	 */
	public function action_settings()
	{
		// Поля настроек
		$for_extract = array(
			'per_page_home',
			'per_page_frontend',
			'per_page_backend',
		);

		// Если пришли данные POST
		if ($this->is_post())
		{
			// Размеры
			$d = array(array('not_empty'), array('digit'));

			// Фильтруем, валидируем
			$post = Validation::factory(array_map('trim', array_map('strip_tags', $_POST)))

				->rules('per_page_home', $d)
				->rules('per_page_frontend', $d)
				->rules('per_page_backend', $d);

			$post->labels(array(
				'per_page_home'     => 'publications.article.per_page_home',
				'per_page_frontend' => 'publications.article.per_page_frontend',
				'per_page_backend'  => 'publications.article.per_page_backend',
			));

			// Если валидация пройдена
			if ($post->check())
			{
				// Обновляем данные
				foreach ($for_extract as $field)
					$this->config['publications'][$field] = $post[$field];

				$this->config->save();

				$this->set_message('success', 'settings.message.ok.save');
				$this->request->redirect(ADMIN . '/publications/settings');
			}
			else
			{
				$this->set_message('error', 'app.message.error_saved');

				// Данныне для шаблона
				$errors = $post->errors('validation');
				$data   = Arr::extract($_POST, $for_extract);
			}
		}

		// Иначе берем из конфига
		else
			$data = Arr::extract($this->config['publications'], $for_extract);

		// Шаблон
		$this->title = __('settings.manager_module');
		$this->block_center = View::factory('backend/publications/v_settings', array('data' => $data))
			->bind('errors', $errors);
	}
}
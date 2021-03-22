<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Статические страницы
 */
class Controller_Ajax_Publications extends Controller_System_Ajax
{
	/**
	 * Изменить статус категории
	 */
	public function action_change_status_catategory()
	{
		$this->_change_status('publications_category');
	}

	/**
	 * Изменить статус статьи
	 */
	public function action_change_status_article()
	{
		$this->_change_status('publications_article');
	}


	/**
	 * Изменить статус
	 *
	 * @param $model
	 * @throws HTTP_Exception_404
	 */
	private function _change_status($model)
	{
		// Если не админ
		if ( ! $this->is_admin)
			throw new HTTP_Exception_404();

		$obj = ORM::factory($model, (int) Arr::get($_POST, 'id'));

		if ($obj->loaded())
		{
			$obj->status = $obj->status ? 0 : 1;
			$obj->save();

			// Формируем ответ серверу
			$this->data['params']['status'] = (bool) $obj->status;
			$this->data['success'] = TRUE;
		}

		// Ответ
		$this->response->body(json_encode($this->data));
	}


	/**
	 * Загружаем изображение к статье
	 *
	 * @throws HTTP_Exception_404
	 */
	public function action_upload_image_for_article()
	{
		// Если не админ
		if ( ! $this->is_admin)
			throw new HTTP_Exception_404();

		// Если есть загружаемое изображение
		if ( ! empty($_FILES) AND isset($_FILES['image']))
		{
			// Объект валидации загружаемого файла
			$image = Validation::factory($_FILES);
			$image->rule('image', 'Upload::valid');
			$image->rule('image', 'Upload::type', array(':value', $this->config['img_ext_allowed']));
			$image->rule('image', 'Upload::image');

			// Если валидация пройдена
			if ($image->check())
			{
				try
				{
					// Генерим имя для файла
					$fname  = sha1(uniqid(NULL, TRUE)) . IMG_DEXT;

					$thumb = PhpThumbFactory::create($image['image']['tmp_name']);
					$thumb->setOptions(array(
						'jpegQuality' => Kohana::$config->load('app.publications.article_image_th_quality')
					));
					$thumb->adaptiveResize(
						Kohana::$config->load('app.publications.article_image_th_width'),
						Kohana::$config->load('app.publications.article_image_th_height')
					);

					// Если добавление
					if (Session::instance()->get('flag_article_action') == 'add')
					{
						$thumb->save(IMG_PUBLICATIONS_DIR . $fname);

						// Предыдущее загруженное изображение
						$uploaded_image = IMG_PUBLICATIONS_DIR . Session::instance()->get('uploaded_image_add');

						// Удаляем
						File::remove($uploaded_image);

						// Сохраняем имя файла загруженного изображения
						Session::instance()->set('uploaded_image_add', $fname);

						// Формируем ответ серверу
						$this->data['status'] = TRUE;
						$this->data['img_id'] = $fname;
						$this->data['params']['image'] = IMG_PUBLICATIONS_URL . '/' . $fname;
					}
					elseif (Session::instance()->get('flag_article_action') == 'edit')
					{
						$thumb->save(IMG_PUBLICATIONS_DIR . $fname);

						// Предыдущее загруженное изображение
						$uploaded_image = IMG_PUBLICATIONS_DIR . Session::instance()->get('uploaded_image_edit');

						// Удаляем
						File::remove($uploaded_image);

						// Сохраняем имя файла загруженного изображения
						Session::instance()->set('uploaded_image_edit', $fname);

						$o_article = ORM::factory('publications_article', Session::instance()->get('flag_article_id'));

						if ($o_article->loaded())
						{
							$o_article->fimage = $fname;
							$o_article->save();
						}

						// Формируем ответ серверу
						$this->data['status'] = TRUE;
						$this->data['img_id'] = $fname;
						$this->data['params']['image'] = IMG_PUBLICATIONS_URL . '/' . $fname;
					}
				}
				catch (Exception $e)
				{
					$this->data['message'] = __('app.message.error_uploaded');
				}
			}
			else
			{
				$this->data['message'] = __('app.message.error_uploaded');
			}

			// Ответ
			$this->response->body(json_encode($this->data));
		}
	}

	/**
	 * Удаление изображения
	 */
	public function action_delete_image_for_article()
	{
		// Если не админ
		if ( ! $this->is_admin)
			throw new HTTP_Exception_404();

		// Получаем имя файла
		$img_id = Arr::get($_POST, 'img_id');

		// Режим добавления или редактирования статьи
		switch (Session::instance()->get('flag_article_action'))
		{
			// Если в режиме добавления статьи
			case 'add':

				// Если файл успешно удален
				if (File::remove(IMG_PUBLICATIONS_DIR . $img_id))
				{
					$this->data['status'] = true;
				}
				break;


			// Если в режиме редактирования статьи
			case 'edit':

				// Статья
				$o_article = ORM::factory('publications_article', Session::instance()->get('flag_article_id'));

				if ($o_article->loaded())
				{
					// Если файл успешно удален
					if (File::remove(IMG_PUBLICATIONS_DIR . $img_id))
					{
						$o_article->fimage = null;
						$o_article->save();

						$this->data['status'] = true;
					}
				}
				break;


			default:
				throw new HTTP_Exception_404();
		}

		// Ответ
		$this->response->body(json_encode($this->data));
	}

	/**
	 * Сохраняем количество комментов для статьи из виджета "Вконтакте"
	 * Поставил другой виджет комментов, это не нужно (оставил для примера)
	 */
	/*
	public function action_num_comments_vk()
	{
		// Получаем данные
		$post = Arr::extract($_POST, array('num', 'last_comment', 'date', 'sign', 'id'));

		// Секретный ключ выданный при регистрации
		$apiSecret = 'FEG19Ua1ZoX7pBCgd9Eu';

		// Хэш
		$hash = md5($apiSecret . $post['date'] . $post['num'] . $post['last_comment']);

		// Проверяем на соответствие
		if (strcmp($hash, $post['sign']) == 0)
		{
			// Статья
			$obj = ORM::factory('publications_article', (int) $post['id']);

			// Если есть такая
			if ($obj->loaded())
			{
				// Сохраняем количество комментов
				$obj->num_comments_vk = $post['num'];
				$obj->save();
			}
		}
	}
	*/
}
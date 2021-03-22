<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Statics extends Controller_Frontend
{
	/**
	 * Вывод статических страниц
	 */
	public function action_index()
	{
		$slug = $this->request->param('slug');

		$o_page = ORM::factory('static')->where('slug', '=', $slug);

		// Если не админ
		if ( ! $this->is_admin)
		{
			// Условие только на опубликованные страницы
			$o_page->where('status', '=', 1);
		}

		$o_page->find();

		// Если страница не найдена - 404
		if ( ! $o_page->loaded())
			throw new HTTP_Exception_404();

		// Если страница контактов
		if ($o_page->slug == 'contacts')
		{
			$v_contacts = $this->_contact_form();
		}


		//==============================================================================================================
		// Используется для подсветки ссылок статических страниц
		$this->slug = $o_page->slug;

		// META
		$this->title       = $o_page->meta_t == '' ? $o_page->title : $o_page->meta_t ;
		$this->description = $o_page->meta_d;
		$this->keywords    = $o_page->meta_k;

		// Шаблон
		$this->block_center = View::factory('frontend/statics/v_index', array('o_page' => $o_page))
			->bind('v_contacts', $v_contacts);
	}


	/**
	 * Контактная форма
	 *
	 * @return Kohana_View
	 */
	private function _contact_form()
	{
        //$to      = 'orders@telviz.net';
        //$to      = 'test@kosmopoisk.ks.ua';
        //$subject = 'XSS attack! 2';
        //$message = 'Java script: <script>alert("XSS attack!");</script>';
        //$headers = 'From: webmaster@example.com' . "\r\n" .
        //    'Reply-To: webmaster@example.com' . "\r\n" .
        //    'X-Mailer: PHP/' . phpversion();
		
		//$message .= 'added string';

        //$res = mail($to, $subject, $message, $headers);
        //var_dump($res);

		// Если POST запрос
		if ($this->is_post())
		{
			// Фильтруем, валидируем
			$post = Validation::factory(array_map('trim', array_map('strip_tags', $_POST)))
				->rule('your_name', 'not_empty')
				->rule('your_email', 'not_empty')
				->rule('your_email', 'email')
				->rule('your_message', 'not_empty');

			$post->labels(array(
				'your_name'    => 'contacts.your_name',
				'your_email'   => 'contacts.your_email',
				'your_message' => 'contacts.your_message',
			));

			// Если валидация пройдена
			if ($post->check() AND Captcha::valid($post['captcha']))
			{
				try
				{
					// Отправляем email
					Email::send($this->config['email'], $post['your_email'], __('contacts.subject'), $post['your_message']);
					Email::send($this->config['email_support'], $post['your_email'], __('contacts.subject'), $post['your_message']);

					$this->set_message('success', 'contacts.message_sended');
					$this->request->redirect('contacts');
				}
				catch (Exception $e)
				{
					$this->set_message('error', 'contacts.error.message_not_sended');
				}
			}
			else
			{
				$errors = $post->errors('validation');
				$errors['captcha'] = __('app.message.error_captcha');
				$this->set_message('error', 'contacts.error.message_not_sended');
			}
		}

		// Шаблон
		return View::factory('frontend/statics/v_contacts', array('captcha' => Captcha::instance()->render()))
			->bind('post', $post)
			->bind('errors', $errors);
	}
}
<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Отвечает за вывод данных на страницу, стили, скрипты
 */
class Controller_System_Template extends Controller_System_Security
{
	public $auto_render = true;
	public $template    = 'frontend/layouts/v_index';

	public $script = array();
	public $styles = array();

	public $title       = '';
	public $keywords    = '';
	public $description = '';

	public $block_left = array(
		'navigation' => '',
	);
	public $block_center = array();
	public $block_right  = array();

	public $message = '';
	public $slug = '';


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Before action
	 */
	public function before()
	{
		parent::before();

		if ($this->auto_render === true)
		{
			// Load the template
			$this->template = View::factory($this->template);

			// Устанавливаем глобальные переменные для шаблонов
			$this->template->set_global('language', $this->language);
			$this->template->set_global('user', $this->user);
			$this->template->set_global('is_admin', $this->is_admin);
			$this->template->set_global('current_controller', $this->request->controller());
			$this->template->set_global('current_action', $this->request->action());

			$this->template->set_global('sitename', $this->config['sitename']);
			$this->template->set_global('siteslogan', $this->config['siteslogan']);
			$this->template->set_global('sitecopy', $this->config['sitecopy']);
			$this->template->set_global('autograph', $this->config['autograph']);

			// Стили
			$this->template->styles = array_merge(
				Arr::get(Kohana::$config->load($this->request->directory())->css, 'app', array()),
				Arr::get(Kohana::$config->load($this->request->directory())->css, $this->request->controller(), array())
			);

			// Скрипты
			$this->template->scripts = array_merge(
				Arr::get(Kohana::$config->load($this->request->directory())->js, 'app', array()),
				Arr::get(Kohana::$config->load($this->request->directory())->js, $this->request->controller(), array())
			);
		}
	}

	/**
	 * After action
	 */
	public function after()
	{
		if ($this->auto_render === true)
		{
			$home_controller = 'home';

			if ($this->request->directory() == 'backend')
				$home_controller = 'dashboard';

			// Если title задан
			if ($this->title)
			{
				// Если на главной странице: "Название сайта - title"
				// Иначе: "title - Название сайта"
				$this->template->title = ($this->request->controller() == $home_controller)
					? $this->config['sitename'] . SEPARATOR . $this->title
					: $this->title . SEPARATOR . $this->config['sitename'];
			}
			else
			{
				$this->template->title = $this->config['sitename'] . SEPARATOR . $this->config['siteslogan'];
			}

			$this->template->description = $this->description ? $this->description : $this->config['meta_d'];
			$this->template->keywords    = $this->keywords ? $this->keywords : $this->config['meta_k'];

			$this->template->block_left   = $this->block_left;
			$this->template->block_center = $this->block_center;
			$this->template->block_right  = $this->block_right;

			$this->template->set_global('slug', $this->slug);

			// Flash-cообщения
			$this->template->message = $this->set_message();

			$this->response->body($this->template->render());
		}

		parent::after();
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Set or get flash messages
	 *
	 *    $this->message('error', 'Ошибка!')
	 *
	 * @param null   $type  available types: success, error, info, warning
	 * @param string $text  text message to display
	 *
	 * @return string
	 */
	public function set_message($type = null, $text = '')
	{
		// Если тип не задан - возвращаем шаблон сообщения
		if ($type === null)
		{
			// Если есть сообщение
			if ($type = $this->session->get_once('type'))
			{
				// Текст сообщения
				$text = $this->session->get_once($type);

				// Возвращаем шаблон сообщения
				return View::factory($this->request->directory() . '/v_message')
					->set('message', array('type' => $type, 'text' => __($text)))
					->render();
			}
		}
		// Устанавливаем сообщение
		else
		{
			$this->session->set('type', $type); // Тип
			$this->session->set($type,  $text); // Текст
		}
	}
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * CKEditor для textarea
 *
 * @param $name
 * @param string $value
 * @param string $height
 * @param string $width
 * @return string
 */
function ckeditor($name, $value = '', $height = '260', $width = '97%')
{
	$url_base = URL::base();

	include_once(DOCROOT . 'assets/vendors/ckeditor/ckeditor.php');
	include_once(DOCROOT . 'assets/vendors/ckfinder/ckfinder.php');

	$CKEditor = new CKEditor();
	$CKEditor->basePath = $url_base . 'assets/vendors/ckeditor/';

	$CKEditor->config['height'] = $height . 'px';
	$CKEditor->config['width']  = $width;

	$CKEditor->config['filebrowserBrowseUrl']      = $url_base . 'assets/vendors/ckfinder/ckfinder.html';
	$CKEditor->config['filebrowserImageBrowseUrl'] = $url_base . 'assets/vendors/ckfinder/ckfinder.html?type=Images';
	$CKEditor->config['filebrowserFlashBrowseUrl'] = $url_base . 'assets/vendors/ckfinder/ckfinder.html?type=Flash';
	$CKEditor->config['filebrowserUploadUrl']      = $url_base . 'assets/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	$CKEditor->config['filebrowserImageUploadUrl'] = $url_base . 'assets/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	$CKEditor->config['filebrowserFlashUploadUrl'] = $url_base . 'assets/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

	$config['uiColor'] = '#efefef';
	$config['toolbar'] = array(
		array('Source','-', 'Maximize', 'ShowBlocks'),
		array('Cut','Copy','Paste','PasteText','PasteFromWord'),
		array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
		array('Link','Unlink','Anchor'),
		array('Image','Table','HorizontalRule','SpecialChar','PageBreak'),
		'/',
		array('Format','Font', 'Bold','Italic','Underline','Strike',),
		array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList'),
		array('Outdent','Indent','-','TextColor','BGColor','-','Subscript','Superscript'),
		array('uiColor')
	);

	ob_start();
	$CKEditor->editor($name, $value, $config);
	return ob_get_clean();
}
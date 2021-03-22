<?php defined('SYSPATH') or die('No direct script access.');

class Model_Static extends ORM
{
	// Чтобы разрешить кеширование
	protected $reload_on_wakeup = FALSE;

	// При изменениях в БД здесь тоже правильно заполнить
	// (можно закомментировать до продакшена
	protected $_table_columns = array(
		'id'           => array('type' => 'int'),
		'title'        => array('type' => 'string'),
		'title_menu'   => array('type' => 'string'),
		'icon_menu'    => array('type' => 'string'),
		'text'         => array('type' => 'string'),
		'slug'         => array('type' => 'string'),
		'meta_t'       => array('type' => 'string'),
		'meta_d'       => array('type' => 'string'),
		'meta_k'       => array('type' => 'string'),
		'status'       => array('type' => 'int'),
		'allow_delete' => array('type' => 'int'),
	);

	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
			),
			'slug' => array(
				array('alpha_dash'),
			),
		);
	}

	public function labels()
	{
		return array(
			'title' => 'statics.title',
			'slug'  => 'seo.url',
		);
	}

	public function filters()
	{
		return array(
			TRUE => array(
				array('trim'),
			),
			'title' => array(
				array('strip_tags'),
			),
			'title_menu' => array(
				array('strip_tags'),
			),
			'icon_menu' => array(
				array('strip_tags'),
			),
		);
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Сохраняем статическую страницу
	 *
	 * @param null|Validation $validation
	 * @return mixed
	 */
	public function save(Validation $validation = NULL)
	{
		if ($this->slug == '' AND $this->id != 1)
			$this->slug = $this->_get_unique_slug($this->title);

		return parent::save($validation);
	}

	/**
	 * Получаем уникальный slug
	 *
	 * @param $title
	 * @return string
	 */
	private function _get_unique_slug($title)
	{
		static $i = 1;
		$original = $slug = Inflector::slug($title);

		while ($post = ORM::factory('static', array('slug' => $slug )) AND $post->loaded() AND $post->id !== $this->id)
		{
			$slug = $original . '-' . $i++;
		}

		return $slug;
	}
}
<?php defined('SYSPATH') or die('No direct script access.');

class Model_Publications_Article extends ORM
{
	// При изменениях в БД здесь тоже правильно заполнить
	// (можно закомментировать до продакшена)
	protected $_table_columns = array(
		'id'          =>array('type' => 'int'),
		'category_id' =>array('type' => 'int'),
		'slug'        =>array('type' => 'string'),
		'title'       =>array('type' => 'string'),
		'preview'     =>array('type' => 'string'),
		'text'        =>array('type' => 'string'),
		'fimage'      =>array('type' => 'string'),
		'meta_t'      =>array('type' => 'string'),
		'meta_d'      =>array('type' => 'string'),
		'meta_k'      =>array('type' => 'string'),
		'created'     =>array('type' => 'string'),
		'updated'     =>array('type' => 'string'),
		'sorter'      =>array('type' => 'int'),
		'status'      =>array('type' => 'int'),
		'source'      =>array('type' => 'string'),
	);


	// Автоматическое обновление даты редактирования записи
	protected $_updated_column = array(
		'column' => 'updated',
		'format' => 'Y-m-d H:i:s'
	);

	//
	protected $_has_many = array(
		'tags' => array(
			'model'   => 'publications_tag',
			'through' => 'publications_articles_tags',
			'foreign_key' => 'article_id',
		),
	);

	// Связь статьи-категория (много-к-одному)
	protected $_belongs_to = array
	(
		'category' => array(
			'model'       => 'publications_category',
			'foreign_key' => 'category_id',
		),
	);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Условия для валидации

	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
			),
			'slug' => array(
				array('alpha_dash'),
			),

			'category_id' => array(
				array('not_empty'),
			),
			'status' => array(
				array('in_array', array(':value', array(0, 1))),
			),
			'source' => array(
				array('url'),
			),
		);
	}

	public function labels()
	{
		return array(
			'title'  => 'publications.article.title',
			'slug'   => 'seo.url',
			'fimage' => 'app.message.error_uploaded',
			'source' => 'publications.article.source',
		);
	}

	public function filters()
	{
		return array(
			TRUE => array(array('trim')),
			'title'  => array(array('strip_tags')),
			'source' => array(array('strip_tags')),
			'meta_t' => array(array('strip_tags')),
			'meta_k' => array(array('strip_tags')),
			'meta_d' => array(
				array(function($value) {
					$value = strip_tags($value);
					$value = str_replace(array("\r", "\n", "\t"), ' ', $value);
					return preg_replace('/ {2,}/', ' ', $value);
				})
			),
		);
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Методы

	/**
	 * Сохраняем статью
	 * Если "Ссылка" пустая - генерим slug из названия статьи
	 *
	 * @param null|Validation $validation
	 * @return mixed
	 */
	public function save(Validation $validation = NULL)
	{
		if ($this->slug == '')
			$this->slug = $this->get_unique_slug($this->title);

		return parent::save($validation);
	}

	/**
	 * Получаем уникальный slug
	 * @param $title
	 * @return string
	 */
	public function get_unique_slug($title)
	{
		static $i = 1;
		$original = $slug = Inflector::slug($title);

		while ($post = ORM::factory('publications_article', array('slug' => $slug )) AND $post->loaded() AND $post->id !== $this->id)
		{
			$slug = $original . '-' . $i++;
		}

		return $slug;
	}

	/**
	 * Валидация категории
	 */
	public static function is_category()
	{
		return Validation::factory($_POST)
			->rule('category_id', 'Model_Publications_Article::check_category', array(':value'));
	}

	/**
	 * Проверяем есть ли выбранная категория
	 *
	 * @static
	 *
	 * @param $value
	 *
	 * @return bool
	 */
	public static function check_category($value)
	{
		// Выбранная категория
		$o_cat = ORM::factory('publications_category', $value);

		// Если есть
		if ($o_cat->loaded())
		{
			// Если не ROOT
			if ($o_cat->id > 1)
				return true;
		}

		return false;
	}
}
<?php defined('SYSPATH') or die('No direct script access.');

class Model_Publications_Category extends ORM_MPTT
{
	// При изменениях в БД здесь тоже правильно заполнить
	// (можно закомментировать до продакшена)
	protected $_table_columns = array(
		'id'          =>array('type' => 'int'),
		'parent_id'   =>array('type' => 'int'),
		'lft'         =>array('type' => 'int'),
		'rgt'         =>array('type' => 'int'),
		'lvl'         =>array('type' => 'int'),
		'scope'       =>array('type' => 'int'),
		'slug'        =>array('type' => 'string'),
		'title'       =>array('type' => 'string'),
		'title_menu'  =>array('type' => 'string'),
		'description' =>array('type' => 'string'),
		'fimage'      =>array('type' => 'string'),
		'meta_t'      =>array('type' => 'string'),
		'meta_d'      =>array('type' => 'string'),
		'meta_k'      =>array('type' => 'string'),
		'sorter'      =>array('type' => 'int'),
		'status'      =>array('type' => 'int'),
		'created'     =>array('type' => 'string'),
	);

	// Время создания категории
	protected $_created_column = array(
		'column' => 'created',
		'format' => 'Y-m-d H:i:s',
	);

	// Связь категории-статьи (один-ко-многим)
	protected $_has_many = array(
		'articles' => array(
			'model'       => 'publications_article',
			'foreign_key' => 'category_id'
		)
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
		);
	}

	public function labels()
	{
		return array(
			'title' => 'publications.category.title',
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
		);
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Методы

	/**
	 * Добавляем категорию
	 * Если "Ссылка" пустая - генерим slug из названия категории
	 *
	 * @access  public
	 * @param   ORM_MPTT|int  primary key value or ORM_MPTT object of target node
	 * @return  ORM_MPTT
	 */
	public function insert_as_last_child($target)
	{
		if ($this->slug == ''){
			$this->slug = $this->_get_unique_slug($this->title);
		}

		return parent::insert_as_last_child($target);
	}

	/**
	 * Сохраняем категорию
	 * Если "Ссылка" пустая - генерим slug из названия категории
	 *
	 * @param null|Validation $validation
	 * @return mixed
	 */
	public function save(Validation $validation = NULL)
	{
		if ($this->slug == '')
			$this->slug = $this->_get_unique_slug($this->title);

		return parent::save($validation);
	}

	/**
	 * Получаем уникальный slug
	 * @param $title
	 * @return string
	 */
	private function _get_unique_slug($title)
	{
		static $i = 1;
		$original = $slug = Inflector::slug($title);

		while ($post = ORM::factory('publications_category', array('slug' => $slug)) AND $post->loaded() AND $post->id !== $this->id)
		{
			$slug = $original . '-' . $i++;
		}

		return $slug;
	}
}

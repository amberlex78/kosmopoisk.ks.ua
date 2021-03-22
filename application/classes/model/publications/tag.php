<?php defined('SYSPATH') or die('No direct script access.');

class Model_Publications_Tag extends ORM
{
	// При изменениях в БД здесь тоже правильно заполнить
	// (можно закомментировать до продакшена)
	protected $_table_columns = array(
		'id'   =>array('type' => 'int'),
		'name' =>array('type' => 'string'),
		'slug' =>array('type' => 'string'),
	);

	protected $_has_many = array(
		'articles' => array(
			'model'   => 'publications_article',
			'through' => 'publications_articles_tags',
			'foreign_key' => 'tag_id',
		),
	);

	public static function add_tags($article_id, $tags)
	{
		$tags = trim(strip_tags($tags));  // Убираем теги
		$tags = explode(',', $tags);      // Разбиваем по запятой в массив
		$tags = array_map('trim', $tags); // Убираем лишние пробелы

		// Удаляем предыдущие теги
		DB::delete('publications_articles_tags')
			->where('article_id', '=', $article_id)
			->execute();

		$slugs = array();

		// Перебираем полученные теги, чтобы добавить в таблицу уникальные
		foreach ($tags as $name)
		{
			// Если имя тега не пустое
			if ($name != '')
			{
				// Получаем slug
				$slug = Inflector::slug($name);

				// Массив slug тегов, которые нужно будет добавить к статье
				$slugs[] = $slug;

				// Если тег уникальный - добавляем в таблицу
				if (self::unique_tag($slug))
				{
					$o_tag = ORM::factory('publications_tag');
					$o_tag->name = $name;
					$o_tag->slug = $slug;
					$o_tag->save();
				}
			}
		}

		if ($slugs)
		{
			// Выбираем из таблице тегов нужные нам
			$o_tags = ORM::factory('publications_tag')
				->where('slug', 'in', $slugs)
				->find_all();

			// Возвращаем массив id-шников тегов для статьи
			return Arr::get_array_ids($o_tags);
		}

		return false;
	}

	/**
	 * Проверка тега на уникальность
	 *
	 * @param $slug
	 *
	 * @return bool
	 */
	public static function unique_tag($slug)
	{
		return ! DB::select(array(DB::expr('COUNT(id)'), 'total'))
			->from('publications_tags')
			->where('slug', '=', $slug)
			->execute()
			->get('total');
	}
}

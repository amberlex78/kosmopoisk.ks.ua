<?php defined('SYSPATH') or die('No direct script access.');
/*
 *
 */
class App_Tree
{
	/**
	 * Получаем массив для вывода в <select>
	 *
	 * @static
	 *
	 * @param $table
	 * @param $select_title
	 *
	 * @return array
	 */
	public static function get_array_for_select($table, $select_title = '---')
	{
		$obj = DB::select('id', 'parent_id', 'lvl', 'title')
			->from($table)
			->order_by('sorter')
			->order_by('id')
			->execute()
			->as_array();

		// Первый в списке
		$tree = array(0 => $select_title);

		App_Tree::_get_tree_as_bi_array(1, $obj, $tree);

		return $tree;
	}


	/**
	 * Получаем правильную структуру дерева в виде двумерного массива
	 *
	 * @static
	 *
	 * @param $parent_id
	 * @param $items
	 * @param $tree
	 */
	private static function _get_tree_as_bi_array($parent_id, $items, &$tree)
	{
		foreach($items as $item)
		{
			if ($item['parent_id'] == $parent_id)
			{
				$tree[$item['id']] = str_repeat(NDASH_SELECT, $item['lvl'] - 2) . $item['title'];

				App_Tree::_get_tree_as_bi_array($item['id'], $items, $tree);
			}
		}
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Получаем дерево в виде ul списка
	 *
	 * @static
	 *
	 * @param $tree
	 * @param $pid
	 *
	 * @return string
	 */
	public static function get_tree_ul($tree, $pid)
	{
		$html = '';

		foreach ($tree as $row)
		{
			if ($row['parent_id'] == $pid)
			{
				$html .= '<li>' . $row['title'] . App_Tree::get_tree_ul($tree, $row['id']) . '</li>';
			}
		}

		return $html ? '<ul>' . $html . '</ul>' : '';
	}


	/**
	 * Строим дерево
	 *
	 * @static
	 *
	 * @param $dataset
	 *
	 * @return array
	 */
	private static function _map_tree($dataset)
	{
		$tree = array();

		foreach ($dataset as $id => &$node)
		{
			// Root
			if ( ! $node['parent_id'])
			{
				$tree[$id] = &$node;
			}

			// Sub
			else
			{
				$dataset[$node['parent_id']]['childs'][$id] = &$node;
			}
		}

		return $tree;
	}
}


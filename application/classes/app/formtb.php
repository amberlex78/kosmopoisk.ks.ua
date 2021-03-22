<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Twitter Bootstrap Form
 * Хелпер формы для использования в админке
 *
 * Используется CSS framework - Bootstrap, from Twitter
 * http://twitter.github.com/bootstrap/components.html
 *
 * TODO: деревянно, нужно как-то переделать и дополнить элементами
 */
class App_Formtb
{
	/**
	 * Creates a form input. If no type is specified, a "text" type input will be returned.
	 *
	 * Пример:
	 * echo TBForm::input(
	 *     'title',                                    // Имя поля ввода
	 *     $data['title'],                             // Текст в поле
	 *     array('class' => 'input-xxlarge'),          // Стандартные атрибуты для Form::input
	 *     array(
	 *         'label'  => 'Название статьи',          // <label> слева от поля ввода
	 *         'mark'   => TRUE,                       // Маркер обязательного поля
	 *         'help'   => 'Отображается на странице', // Текст подсказки под полем ввода
	 *         'errors' => $errors                     // Если предполагается массив ошибок
	 *     )
	 * );
	 *
	 * @static
	 * @param $name
	 * @param null $value
	 * @param array|null $attributes - Стандартные атрибуты для Form::input
	 * @param array|null $params - массив параметров ['label', 'mark', 'help', 'errors']
	 * @return string
	 */
	public static function input($name, $value = NULL, array $attributes = NULL, array $params = NULL)
	{
		if ( ! isset($attributes['id']))
			$attributes['id'] = $name;

		return self::_get_tpl($name, $params, Form::input($name, $value, $attributes));
	}


	/**
	 * Creates a password form input.
	 *
	 * @static
	 * @param $name
	 * @param null $value
	 * @param array|null $attributes - Стандартные атрибуты для Form::input
	 * @param array|null $params - массив параметров ['label', 'mark', 'help', 'errors']
	 * @return string
	 */
	public static function password($name, $value = NULL, array $attributes = NULL, array $params = NULL)
	{
		$attributes['type'] = 'password';

		return self::input($name, $value, $attributes, $params);
	}


	/**
	 * Creates a file upload form input. No input value can be specified.
	 *
	 * @static
	 * @param $name
	 * @param array|null $attributes - Стандартные атрибуты для Form::input
	 * @param array|null $params - массив параметров ['label', 'mark', 'help', 'errors']
	 * @return string
	 */
	public static function file($name, array $attributes = NULL, array $params = NULL)
	{
		$attributes['type'] = 'file';

		return self::input($name, NULL, $attributes, $params);
	}


	/**
	 * Creates a textarea form input.
	 *
	 * Пример:
	 * echo TBForm::textarea(
	 *     'description',
	 *     $data['description'],
	 *     array(
	 *         'class' => 'input-xxlarge',
	 *         'rows'  => 5
	 *     ),
	 *     array(
	 *         'label' => 'Краткое описание',
	 *         'help'  => 'Краткое описание статьи, анонс'
	 *     )
	 * );
	 *
	 * @static <input type="text"></input>
	 * @param $name
	 * @param string $body
	 * @param array|null $attributes - Стандартные атрибуты для Form::textarea
	 * @param array|null $params - массив параметров ['label', 'mark', 'help', 'errors']
	 * @param bool $double_encode
	 * @return string
	 */
	public static function textarea($name, $body = '', array $attributes = NULL, array $params = NULL, $double_encode = TRUE)
	{
		if ( ! isset($attributes['id']))
			$attributes['id'] = $name;

		return self::_get_tpl($name, $params, Form::textarea($name, $body, $attributes, $double_encode));
	}


	/**
	 * Creates a select form input.
	 *
	 * @static
	 * @param $name
	 * @param array|null $options
	 * @param null $selected
	 * @param array|null $attributes - Стандартные атрибуты для Form::select
	 * @param array|null $params - массив параметров ['label', 'mark', 'help', 'errors']
	 * @return string
	 */
	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL, array $params = NULL)
	{
		if ( ! isset($attributes['id']))
			$attributes['id'] = $name;

		return self::_get_tpl($name, $params, Form::select($name, $options, $selected, $attributes));
	}


	/**
	 * Creates a textarea as CKEditor.
	 *
	 * @static
	 * @param $name
	 * @param string $body
	 * @param array|null $params
	 * @param string $height
	 * @param string $width
	 * @return string
	 */
	public static function ckeditor($name, $body = '', array $params = NULL, $height = '260', $width = '97%')
	{
		return self::_get_tpl($name, $params, ckeditor($name, $body, $height, $width));
	}


	/**
	 * Шаблон для элемента формы
	 *
	 * @static
	 * @param $name
	 * @param $params
	 * @param $element
	 * @return string
	 */
	private static function _get_tpl($name, $params, $element)
	{
		$params = self::_params($name, $params);

		// Шаблон
		return '
			<div class="control-group ' . $name . $params['err_class'] . '">
				' . $params['label'] . '
				<div class="controls">
					' . $element . '
					' . $params['err_string'] . '
					' . $params['help'] . '
				</div>
			</div>
		';
	}


	/**
	 * Парсим параметры для формы
	 *
	 * @static
	 * @param $name
	 * @param $params:
	 *     mark   - Маркер для обозначения обязательного поля
	 *     help   - Текст подсказки под полем
	 *     errors - Массив ошибок валидации, если есть
	 * @return array
	 */
	private static function _params($name, $params)
	{
		$inline = (isset($params['help_inline']) AND $params['help_inline'] === true) ? 'inline' : 'block';

		$params['help'] = isset($params['help'])
			? '<span class="help-' . $inline . '">' . __($params['help']) . '</span>'
			: '';

		$params['label'] = isset($params['label'])
			? '<label for="' . $name . '" class="control-label">' . __($params['label']) . (isset($params['mark']) ? '&nbsp;<span class="mark">*</span>' : '') . '</label>'
			: '';

		$params['err_string'] = $params['err_class'] = '';

		if (isset($params['errors']))
		{
			$errors = array_merge($params['errors'], (isset($params['errors']['_external']) ? $params['errors']['_external'] : array()));

			if (isset($errors[$name]))
			{
				$params['err_class']  = ' error';
				$params['err_string'] = '<p class="help-' . $inline . '">' . $errors[$name] . '</p>';
			}
		}

		return $params;
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Кнопки, ссылки

	/**
	 * Ссылка-кнопка
	 *
	 * @static
	 *
	 * @param        $uri
	 * @param        $title
	 * @param string $name
	 *
	 * @return string
	 */
	public static function btn($uri, $title, $name = 'add')
	{
		switch ($name)
		{
			case 'add': $ico = 'plus'; break;

			default: $ico = '';
		}

		$ico = $ico ? '<i class="icon-' . $ico . ' icon-white"></i> ' : '';

		return HTML::anchor($uri, $ico . __($title), array('class' => 'btn btn-primary'));
	}


	/**
	 * Кнопки save и reset
	 *
	 * @static
	 * @param string $name
	 * @return string
	 */
	public static function btns($name = '')
	{
		if ($name !== '')
			$name = ' value="' . $name . '" name="' . $name . '"';

		return '
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"' . $name . '>
					<i class="icon-ok icon-white"></i>
					' . __('app.action.save') . '
				</button>
				<button type="reset" class="btn">
					<i class="icon-ban-circle icon"></i>
					' . __('app.action.reset') . '
				</button>
			</div>
		';
	}
}
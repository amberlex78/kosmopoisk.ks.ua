var APP = {

	/**
	 * Путь к контроллеру
	 */
	AJAX_URL: '/ajax/',

	/**
	 * Генератор лоадеров
	 * http://www.ajaxload.info
	 */
	AJAX_IMG_LOADER: '<img src="/assets/img/ajax-loader.gif" />',

	/**
	 * Тексты сообщений
	 * TODO: перенести куда-то в lang
	 */
	msg: {
		caption: {
			on:  'Вкл.',
			off: 'Выкл.'
		},
		err: {
			transmission: 'Ошибка отправки/принятия данных!'
		},
		confirm: {
			delete_static: 'Удалить страницу?',
			delete_category: 'Внимание! Все вложенные категории и статьи будут удалены! Удалить категорию?',
			delete_article: 'Удалить статью?',
			delete_image: 'Удалить изображение?'
		},
		info: {
		}
	},


	/**
	 * Flash Messages
	 *
	 * Result: <div class="alert alert-error">Обязательное поле!</div>
	 *
	 * @param message
	 * @param type (error || success || info)
	 */
	alert: function(message, type)
	{
		var type = ' alert-' + type || '' ;

		return '<div class="alert' + type + '">' + message + '</div>';
	}

};

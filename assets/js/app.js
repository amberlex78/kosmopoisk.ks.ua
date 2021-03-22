var APP = {

	BASE_URL: '/',

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
		err: {
			search_lenth: 'Введите не менее 3-х символов!'
		},
		confirm: {
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

$(function() {

	// Проверяем на количество символов
	$('#frm_search').submit(function() {
		var search_input = $('input[name="search_string"]');
		if (search_input.val().trim().length < 3) {
			alert(APP.msg.err.search_lenth);
			search_input.focus();
			return false;
		};
		return true;
	});

	$('.captcha-refresh').click(function() {
		var id = Math.floor(Math.random() * 1000000);
		$('img.captcha').attr('src', APP.BASE_URL + 'captcha/default?id=' + id);
	});

});

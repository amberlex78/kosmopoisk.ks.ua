<?php defined('SYSPATH') or die('No direct script access.');

return array
(
//======================================================================================================================
//  Глобальные

	'app.caption.to_site'       => 'На сайт',
	'app.caption.main'          => 'Главная',
	'app.caption.admin'         => 'Администрирование',
	'app.caption.dashboard'     => 'Панель администрирования',
	'app.caption.search'        => 'Поиск...',
	'app.caption.captcha'       => 'Введите код',
	'app.caption.status'        => 'Статус',
	'app.caption.status_on'     => 'Вкл.',
	'app.caption.status_off'    => 'Выкл.',
	'app.caption.params'        => 'Параметры',
	'app.caption.navigation'    => 'Навигация',
	'app.caption.share'         => 'Поделиться',
	'app.caption.other'         => 'Другое',

	'app.caption.search_result'     => 'Результаты поиска',
	'app.caption.search_result_tag' => 'Результаты поиска по тегам',
	'app.caption.tag_cloud'         => 'Облако тегов',
	'app.caption.tag'               => 'Тег',
	'app.caption.tags'              => 'Теги',

//  Действия
	'app.action.actions'        => 'Действия',
	'app.action.add'            => 'Добавить',
	'app.action.save'           => 'Сохранить',
	'app.action.edit'           => 'Редактировать',
	'app.action.delete'         => 'Удалить',
	'app.action.reset'          => 'Сбросить',
	'app.action.cancel'         => 'Выйти',
	'app.action.back'           => 'Назад',
	'app.action.forward'        => 'Вперед',
	'app.action.go_top'         => 'Наверх',
	'app.action.upload_image'   => 'Загрузить изображение',
	'app.action.back_page'      => 'Вернуться на предыдущую страницу',

// Сообщения
	'app.message.ok_edited'      => 'Изменения успешно сохранены!',
	'app.message.ok_saved'       => 'Сохранение прошло успешно!',
	'app.message.ok_deleted'     => 'Удаление прошло успешно!',

// Ошибки
	'app.message.error_saved'      => 'Ошибка сохранения!',
	'app.message.error_deleted'    => 'Ошибка удаления!',
	'app.message.error_captcha'    => 'Неверный код!',
	'app.message.error_uploaded'   => 'Ошибка загрузки!',
	'app.message.error_search'     => 'Ничего не найдено!',
	'app.message.error_search_num' => 'Для поиска необходимо ввести не менее 3-х символов!',
	'app.message.error_404'        => '<h1>Ошибка 404</h1>Страница не найдена!',
	'app.message.error_403'        => '<h1>Ошибка 403</h1>Доступ запрещен!',
	'app.message.error_500'        => '<h1>Ошибка 500</h1>Внутренняя ошибка сервера!',
	'app.message.error_503'        => '<h1>Ошибка 503</h1>Сервис временно недоступен!',


//======================================================================================================================
//  Постраничка

	'pagination.backend_first'     => '<<',
	'pagination.backend_previous'  => '<',
	'pagination.backend_next'      => '>',
	'pagination.backend_last'      => '>>',

	'pagination.frontend_first'    => '<<',
	'pagination.frontend_previous' => 'Сюда',
	'pagination.frontend_next'     => 'Туда',
	'pagination.frontend_last'     => '>>',


// Глобальные (end)
//======================================================================================================================





//======================================================================================================================
//  Настройки
//======================================================================================================================

	'settings.heading'        => 'Настройки',
	'settings.manager_global' => 'Глобальные настройки',
	'settings.manager_module' => 'Настройки модуля',

	// Сообщения
	'settings.message.ok.save' => 'Настройки сохранены!',

	// Надписи (глобальные настройки)
	'settings.sitename'     => 'Название сайта',
	'settings.sitename_h'   => 'Показывается в шапке сайта, используется в заголовках страниц',
	'settings.siteslogan'   => 'Слоган',
	'settings.siteslogan_h' => 'Показывается в шапке сайта под названием сайта',
	'settings.sitecopy'     => 'Копирайт',
	'settings.sitecopy_h'   => 'Показывается в подвале сайта. Смотрим здесь: <a href="http://habrahabr.ru/post/23812/">© В. И. Пупкин, 2008</a>',
	'settings.autograph'    => 'Подпись',
	'settings.autograph_h'  => 'Показывается под размещенной статьей',
	'settings.email'        => 'Email',
	'settings.email_h'      => 'Email сайта для связи, сообщений',


//======================================================================================================================
//  Контакты
//======================================================================================================================

// Ошибки
	'contacts.error.message_not_sended' => 'Ошибка при отправке сообщения!',
// Надписи
	'contacts.title_send'     => 'Отправить мне сообщение',
	'contacts.your_name'      => 'Ваше имя',
	'contacts.your_email'     => 'Ваш email',
	'contacts.your_email_h'   => '(не будет опубликован)',
	'contacts.subject'        => '[Херсон – Космопоиск - Обратная связь]',
	'contacts.your_message'   => 'Сообщение',
	'contacts.send_message'   => 'Отправить',
	'contacts.message_sended' => 'Ваше сообщение успешно отправлено!',


//======================================================================================================================
//  Авторизация, пользователи
//======================================================================================================================

	'users.heading' => 'Управление пользователями',

// Ошибки
	'users.error.auth' => 'Ошибка авторизации!',
// Надписи
	'users.authorization' => 'Авторизация',
	'users.sign_in'       => 'Войти',
	'users.sign_out'      => 'Выйти',
	'users.login'         => 'Логин',
	'users.logout'        => 'Выход',
	'users.login_new'     => 'Новый логин',
	'users.password'      => 'Пароль',
	'users.password_new'  => 'Новый пароль',
	'users.profile'       => 'Профиль',
	'users.profile_edit'  => 'Изменить свой профиль',
	'users.caption_users' => 'Пользователи',
	'users.caption_user'  => 'Пользователь',
	'users.email'         => 'Email',
	'users.admin_created' => 'Администратор создан',

//======================================================================================================================
//  Статические страницы
//======================================================================================================================

	'statics.heading'       => 'Статические страницы',
	'statics.manager_pages' => 'Управление страницами',

// CRUD
	'statics.add'     => 'Добавить страницу',
	'statics.added'   => 'Страница добавлена!',
	'statics.edit'    => 'Редактировать страницу',
	'statics.edited'  => 'Страница изменена!',
	'statics.delete'  => 'Удалить страницу',
	'statics.deleted' => 'Страница удалена!',

// Надписи
	'statics.page.caption' => 'Cтраница',
	'statics.amount'       => 'Количество страниц',
	'statics.title'        => 'Название страницы',
	'statics.title_menu'   => 'Название пункта меню',
	'statics.title_menu_h' => 'Название пункта меню для этой страницы (для отображения на сайте) <br/> Если не указано - будет совпадать с названием страницы',
	'statics.icon_menu'    => 'Иконка для меню',
	'statics.icon_menu_h'  => 'Иконки показываются рядом с пунктом меню. Допустимые смотрим <a target="_blank" href="http://twitter.github.com/bootstrap/base-css.html#icons">здесь</a>',
	'statics.text'         => 'Текст страницы',


//======================================================================================================================
//  Управление публикациями
//======================================================================================================================

	'publications.heading'            => 'Публикации',
	'publications.manager_categories' => 'Управление категориями',
	'publications.manager_articles'   => 'Управление статьями',

// Ошибки
	'publications.error.no_selected_category' => 'Категория не выбрана!',

// CRUD
	'publications.category.add'     => 'Добавить категорию',
	'publications.category.added'   => 'Категория добавлена!',
	'publications.category.edit'    => 'Редактировать категорию',
	'publications.category.edited'  => 'Категория изменена!',
	'publications.category.delete'  => 'Удалить категорию',
	'publications.category.deleted' => 'Категория удалена!',
// Надписи
	'publications.category.caption'       => 'Категория',
	'publications.category.title'         => 'Название категории',
	'publications.category.title_h'       => 'Название категории выводится на странице в теге h1',
	'publications.category.title_menu'    => 'Название пункта меню',
	'publications.category.title_menu_h'  => 'Название пункта меню для этой категории (для отображения на сайте) <br/> Если не указано - будет совпадать с названием категории',
	'publications.category.description'   => 'Описание категории',
	'publications.category.amount'        => 'Категорий',
	'publications.category.no_categories' => 'Категорий нет',
	'publications.category.select'        => 'Выберите категорию',
	'publications.category.not_selected'  => '--- Категория не выбрана ---',

// CRUD
	'publications.article.add'     => 'Добавить статью',
	'publications.article.added'   => 'Статья добавлена!',
	'publications.article.edit'    => 'Редактировать статью',
	'publications.article.edited'  => 'Статья изменена!',
	'publications.article.delete'  => 'Удалить статью',
	'publications.article.deleted' => 'Статья удалена!',
	'publications.article.founded' => 'Найдено статей',
// Надписи
	'publications.article.caption'           => 'Статья',
	'publications.article.last_articles'     => 'Последние статьи',
	'publications.article.title'             => 'Название статьи',
	'publications.article.title_h'           => 'Название статьи выводится на странице в теге h1',
	'publications.article.preview'           => 'Анонс статьи',
	'publications.article.text'              => 'Полный текст статьи',
	'publications.article.tags'              => 'Теги',
	'publications.article.source'            => 'Первоисточник',
	'publications.article.source_h'          => 'Ссылка на сайт-первоисточник информации, если таковой имеется',
	'publications.article.tags_h'            => 'Теги (метки) для статьи через запятую. По ним может производиться поиск с главной страницы сайта <br><a href="https://kosmopoisk.ks.ua#tags" target="_blank">Посмотреть список тегов</a> (откроется в новой вкладке)',
	'publications.article.amount'            => 'Статей',
	'publications.article.no_articles'       => 'Статей нет',
	'publications.article.per_page'          => 'Количество статей на странице',
	'publications.article.per_page_home'     => 'На главной',
	'publications.article.per_page_frontend' => 'На сайте',
	'publications.article.per_page_backend'  => 'В админке',


//======================================================================================================================
//  SEO
//======================================================================================================================

	'seo.caption' => 'SEO',
	'seo.url'     => 'Ссылка',
	'seo.url_h'   => 'Если не указана, будет сгенерирована автоматически<br/>(может содержать только английские буквы, цифры, тире и нижнее подчёркивание)',

	'seo.meta_t'            => 'Заголовок (title)',
	'seo.meta_t_site_h'     => 'Этот заголовок будет использован в <b>title</b> для этого сайта',
	'seo.meta_t_module_h'   => 'Этот заголовок будет использован в <b>title</b> для этого модуля',
	'seo.meta_t_page_h'     => 'Этот заголовок будет использован в <b>title</b> для этой страницы<br />Если не указан, используется название страницы',
	'seo.meta_t_category_h' => 'Этот заголовок будет использован в <b>title</b> для этой категории<br />Если не указан, используется название категории',

	'seo.meta_d'            => 'Описание (description)',
	'seo.meta_d_site_h'     => 'Это описание будет использовано в <b>meta description</b> для этого сайта (не более 250 символов)',
	'seo.meta_d_module_h'   => 'Это описание будет использовано в <b>meta description</b> для этого модуля (не более 250 символов)',
	'seo.meta_d_page_h'     => 'Это описание будет использовано в <b>meta description</b> для этой страницы (не более 250 символов)<br />Если не указано, берется из глобальных настроек',
	'seo.meta_d_category_h' => 'Это описание будет использовано в <b>meta description</b> для этой категории (не более 250 символов)<br />Если не указано, берется из глобальных настроек',

	'seo.meta_k'            => 'Ключевые слова (keywords)',
	'seo.meta_k_site_h'     => 'Эти слова будут использованы в <b>meta keywords</b> для этого сайта (через запятую, не более 20 слов)',
	'seo.meta_k_module_h'   => 'Эти слова будут использованы в <b>meta keywords</b> для этого модуля (через запятую, не более 20 слов)',
	'seo.meta_k_page_h'     => 'Эти слова будут использованы в <b>meta keywords</b> для этой страницы (через запятую, не более 20 слов)<br />Если не указаны, берутся из глобальных настроек',
	'seo.meta_k_category_h' => 'Эти слова будут использованы в <b>meta keywords</b> для этой категории (через запятую, не более 20 слов)<br />Если не указаны, берутся из глобальных настроек',


//======================================================================================================================
//  Сообщения ошибок валидации
//  Кохановские system/messages/validation.php скопированы в application/messages/validation.php
//  Здесь перевод для этого файла
//======================================================================================================================

	//'validation.not_empty'     => 'Значение поля `:field` не должно быть пустым',
	'validation.not_empty'     => 'Обязательное поле',
	'validation.alpha'         => 'Значение поля `:field` должно содержать только буквы',
	'validation.alpha_dash'    => 'Значение поля `:field` должно содержать только <strong>английские буквы</strong>, цифры, тире и нижнее подчёркивание',
	'validation.alpha_numeric' => 'Значение поля `:field` должно содержать только буквы и цифры',
	'validation.color'         => 'Значение поля `:field` должно обозначать цвет',
	'validation.credit_card'   => 'Значение поля `:field` должно содержать правильный номер кредитной карты',
	'validation.date'          => 'Значение поля `:field` должно содержать дату',
	'validation.decimal'       => 'Значение поля `:field` должно содержать десятичное число с коичеством знаков равным :param2',
	'validation.digit'         => 'Значение поля `:field` должно содержать цифры',
	'validation.email'         => 'Значение поля `:field` должно содержать правильны email адрес',
	'validation.email_domain'  => 'Значение поля `:field` должно содержать корректный email домен',
	'validation.equals'        => 'Значение поля `:field` должно быть равным :param2',
	'validation.exact_length'  => 'Значение поля `:field` должно содержать ровно :param2 знак(а,ов)',
	'validation.in_array'      => 'Значение поля `:field` должно быть из списка возможных значений',
	'validation.ip'            => 'Значение поля `:field` должно быть правильным ip адресом',
	'validation.matches'       => 'Значение поля `:field` должно таким же как `:param2`',
	'validation.min_length'    => 'Значение поля `:field` должно быть не менее :param2 знаков(а) длиной',
	'validation.max_length'    => 'Значение поля `:field` должно быть менее :param2 знаков(а)',
	'validation.numeric'       => 'Значение поля `:field` должно числовым',
	'validation.phone'         => 'Значение поля `:field` должно представлять номер телефона',
	'validation.range'         => 'Значение поля `:field` должно быть в пределах от :param2 до :param3',
	'validation.regex'         => 'Значение поля `:field` должно быть в указанном формате',
	'validation.url'           => 'Значение поля `:field` должно представлять правильный url адрес',
);
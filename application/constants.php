<?php defined('SYSPATH') or die('No direct script access.');

// Переопределяем для краткой записи
define('DS', DIRECTORY_SEPARATOR);

// Название пути в URL к админке (можно изменить для секьюрити)
define('ADMIN', 'admin');

// Разделитель в заголовке окна браузера
define('SEPARATOR', ' - ');

// Тире для отступа в <select>
define('NDASH_SELECT', '&ndash;&nbsp;&nbsp;');
define('MDASH_SELECT', '&mdash;&nbsp;&nbsp;');

define('ICO_REMOVE', '<i class="icon-remove icon-white"></i>');
define('ICO_PENCIL', '<i class="icon-pencil"></i>');
define('ICO_PLUS',   '<i class="icon-plus"></i>');
define('ICO_PLUS_W', '<i class="icon-plus-sign icon-white"></i>');
define('ICO_SEARCH', '<i class="icon-search"></i>');

// Расширение для создаваемых (загружаемых) изображений
define('IMG_EXT', 'jpg');
define('IMG_DEXT', '.jpg');

// Папка для изображений публикаций
define('IMG_PUBLICATIONS_DIR', DOCROOT . 'uploads' . DS . 'publications' . DS);
define('IMG_PUBLICATIONS_URL', Url::base() . 'uploads/publications/');

// Временная папка
define('IMG_TMP_DIR', DOCROOT . 'uploads' . DS . 'tmp' . DS);
define('IMG_TMP_URL', Url::base() . 'uploads/tmp/');

-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.29 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных kosmopoisk
CREATE DATABASE IF NOT EXISTS `kosmopoisk` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kosmopoisk`;

-- Дамп структуры для таблица kosmopoisk.publications_articles
CREATE TABLE IF NOT EXISTS `publications_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `preview` text,
  `text` mediumtext,
  `fimage` varchar(255) DEFAULT NULL,
  `meta_t` varchar(255) DEFAULT NULL,
  `meta_d` varchar(255) DEFAULT NULL,
  `meta_k` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `sorter` int(11) unsigned NOT NULL DEFAULT '9999',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_publications_articles_publications_categories_id` (`category_id`),
  CONSTRAINT `FK_publications_articles_publications_categories_id` FOREIGN KEY (`category_id`) REFERENCES `publications_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=361 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.publications_articles: ~3 rows (приблизительно)
DELETE FROM `publications_articles`;
/*!40000 ALTER TABLE `publications_articles` DISABLE KEYS */;
INSERT INTO `publications_articles` (`id`, `category_id`, `slug`, `title`, `preview`, `text`, `fimage`, `meta_t`, `meta_d`, `meta_k`, `created`, `updated`, `sorter`, `status`, `source`) VALUES
	(358, 69, 'novost-1', 'Новость-1', 'Новость-1 Анонс', '<p>\n	Новость-1 Полный текст</p>', '208fb981ac5f5d0256fa962e7a3362c43c0b759c.jpg', 'Новость-1', 'Новость-1 Анонс', 'Новость-1', '2021-03-22 04:29:15', '2021-03-22 04:42:28', 9999, 1, 'http://example.com/'),
	(359, 69, 'novost-2', 'Новость-2', 'Новость-2 Анонс', '<p>\n	Новость-2 Полный текст</p>', '', 'Новость-2', 'Новость-2 Анонс', 'Новость-2', '2021-03-22 04:38:17', '2021-03-22 04:41:44', 9999, 0, ''),
	(360, 69, 'novost-3', 'Новость-3', 'Новость-3 Анонс', '<p>\n	Новость-3 Полный текст</p>', '', 'Новость-3', 'Новость-3 Анонс', 'Новость-3', '2021-03-22 04:39:23', '2021-03-22 04:41:10', 9999, 0, '');
/*!40000 ALTER TABLE `publications_articles` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.publications_articles_tags
CREATE TABLE IF NOT EXISTS `publications_articles_tags` (
  `article_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  KEY `FK_publications_art2tag_publications_articles_id` (`article_id`),
  KEY `FK_publications_art2tag_publications_tags_id` (`tag_id`),
  CONSTRAINT `FK_publications_art2tag_publications_articles_id` FOREIGN KEY (`article_id`) REFERENCES `publications_articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_publications_art2tag_publications_tags_id` FOREIGN KEY (`tag_id`) REFERENCES `publications_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.publications_articles_tags: ~2 rows (приблизительно)
DELETE FROM `publications_articles_tags`;
/*!40000 ALTER TABLE `publications_articles_tags` DISABLE KEYS */;
INSERT INTO `publications_articles_tags` (`article_id`, `tag_id`) VALUES
	(358, 292),
	(358, 293);
/*!40000 ALTER TABLE `publications_articles_tags` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.publications_categories
CREATE TABLE IF NOT EXISTS `publications_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) unsigned NOT NULL,
  `rgt` int(11) unsigned NOT NULL,
  `lvl` tinyint(4) unsigned NOT NULL,
  `scope` tinyint(4) unsigned NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_menu` varchar(255) DEFAULT NULL,
  `description` text,
  `fimage` varchar(255) DEFAULT NULL,
  `meta_t` varchar(255) DEFAULT NULL,
  `meta_d` varchar(255) DEFAULT NULL,
  `meta_k` varchar(255) DEFAULT NULL,
  `sorter` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- Дамп данных таблицы kosmopoisk.publications_categories: ~3 rows (приблизительно)
DELETE FROM `publications_categories`;
/*!40000 ALTER TABLE `publications_categories` DISABLE KEYS */;
INSERT INTO `publications_categories` (`id`, `parent_id`, `lft`, `rgt`, `lvl`, `scope`, `slug`, `title`, `title_menu`, `description`, `fimage`, `meta_t`, `meta_d`, `meta_k`, `sorter`, `status`, `created`) VALUES
	(1, 0, 1, 6, 1, 1, NULL, 'ROOT', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2012-10-02 04:08:40'),
	(69, 1, 2, 3, 2, 1, 'novosti', 'Новости', 'Новости', '<p>События, новости.</p>', NULL, '', '', '', 0, 1, '2012-10-21 14:27:03'),
	(74, 1, 4, 5, 2, 1, 'kosmos', 'Космос', 'Космос', '<p>Новости и события из области космической техники, новинки, открытия.</p>', NULL, '', 'Новости и события из области космической техники, новинки, открытия.', 'Космос, новости техники, наука, технологии', 0, 1, '2012-10-23 19:48:08');
/*!40000 ALTER TABLE `publications_categories` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.publications_tags
CREATE TABLE IF NOT EXISTS `publications_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.publications_tags: ~2 rows (приблизительно)
DELETE FROM `publications_tags`;
/*!40000 ALTER TABLE `publications_tags` DISABLE KEYS */;
INSERT INTO `publications_tags` (`id`, `name`, `slug`) VALUES
	(292, 'tag-1', 'tag-1'),
	(293, 'tag-2', 'tag-2');
/*!40000 ALTER TABLE `publications_tags` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.roles: ~2 rows (приблизительно)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
	(1, 'login', 'Login privileges, granted after account confirmation'),
	(2, 'admin', 'Administrative user, has access to everything.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.roles_users
CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.roles_users: ~2 rows (приблизительно)
DELETE FROM `roles_users`;
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
	(6, 1),
	(6, 2);
/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.statics
CREATE TABLE IF NOT EXISTS `statics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_menu` varchar(255) DEFAULT NULL,
  `icon_menu` varchar(255) DEFAULT NULL,
  `text` text,
  `slug` varchar(255) NOT NULL,
  `meta_t` varchar(255) DEFAULT NULL,
  `meta_d` varchar(255) DEFAULT NULL,
  `meta_k` varchar(255) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_delete` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sorter` int(11) unsigned NOT NULL DEFAULT '999',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_content_statics_slug` (`slug`),
  KEY `IX_content_statics_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

-- Дамп данных таблицы kosmopoisk.statics: ~2 rows (приблизительно)
DELETE FROM `statics`;
/*!40000 ALTER TABLE `statics` DISABLE KEYS */;
INSERT INTO `statics` (`id`, `title`, `title_menu`, `icon_menu`, `text`, `slug`, `meta_t`, `meta_d`, `meta_k`, `status`, `allow_delete`, `sorter`) VALUES
	(1, 'Научно-исследовательское объединение «Херсон – Космопоиск»', 'Главная', 'icon-home', '<p>\n	Приветствуем Вас на официальном сайте Херсонского регионального отделения Международного общественного научно-исследовательского объединения &laquo;Космопоиск&raquo;</p>\n<p>\n	&nbsp;</p>\n<p>\n	Идейный организатор и координатор &laquo;Космопоиска&raquo; &mdash; Чернобров Вадим Александрович, инженер-конструктор космических летательных аппаратов, писатель, исследователь.</p>\n<p>\n	Руководитель группы Херсонского отделения &mdash; Девятаева Н.И., учитель физики.</p>\n<p>\n	&laquo;Херсон &ndash; Космопоиск&raquo; организован на территории г. Голая Пристань Херсонской области, родине многих знаменитых людей. Город и район окружен Чёрным морем, рекой Днепр с притоками, степью, самой большой в Европе пустыней Олешковские пески и лечебным озером с целебными грязями Соляное.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Интересы членов группы &laquo;Херсон-Космопоиск&raquo;: уфология, астрономия, космонавтика, геология, загадки истории, криптобиология, темпорология, цереология, аномалистика, космическая медицина, экология, творчество.</p>', '', '', '', '', 1, 0, 1),
	(2, 'Контактная информация', 'Контакты', 'icon-envelope', '<address>\n	<p>\n		<strong><img alt="Пупкин В. И." class="img-polaroid left" src="/uploads/images/contact/depositphotos_13269188-stock-photo-extraterrestrial-alien.jpg" style="width: 150px; height: 150px;" />Пупкин В. И.</strong></p>\n	<p>\n		Руководитель группы Херсон-Космопоиск</p>\n	<p>\n		Украина, Херсон</p>\n	<p>\n		<abbr title="Телефон">Тел:</abbr> (050) 111-11-11</p>\n</address>', 'contacts', 'Контакты, обратная связь', '', '', 1, 0, 4);
/*!40000 ALTER TABLE `statics` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.users: ~0 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
	(6, 'admin@gmail.com', 'admin', 'd9d265eb470e808abb3b1ffb9c250a45a765ef7064513d40a24c123d007a72d2', 378, 1616396952);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Дамп структуры для таблица kosmopoisk.user_tokens
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kosmopoisk.user_tokens: ~0 rows (приблизительно)
DELETE FROM `user_tokens`;
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

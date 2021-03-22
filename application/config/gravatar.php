<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	// Size of the image in pixels
	'size' => 80,

	// The default image, FALSE is the G, can also use identicon, monsterid, wavatar, retro or 404
	'default_image' => 'wavatar',

	/**
	 * Default rating [Gravatar::G, Gravatar::PG, Gravatar::R, Gravatar::X]
	 *
	 * g  — Для использования на любых сайтах.
	 * pg — Может содержать грубые, оскорбительные слова, сцены насилия, эротические изображения.
	 * r  — Может содержать нецензурные выражения, жестокие сцены насилия, обнажённое тело, а также пропаганду наркотиков.
	 * x  — Содержание подходит только для взрослой возрастной категории.
	 */
	'rating' => Gravatar::PG,

	// Additional attributes that are added into the <img> tag
	'attrs' => array(
		'class' => 'gravatar img-polaroid',
		'alt'   => 'user gravatar'
	),
);
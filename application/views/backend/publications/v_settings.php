<?php defined('SYSPATH') or die('No direct script access.');

echo Form::open(Request::current(), array('class'=>'form-horizontal'));

	echo __('publications.article.per_page') . ':<hr />';

	echo App_Formtb::input('per_page_home', $data['per_page_home'], NULL,
		array('label' => 'publications.article.per_page_home', 'errors' => $errors, 'mark' => true));

	echo App_Formtb::input('per_page_frontend', $data['per_page_frontend'], NULL,
		array('label' => 'publications.article.per_page_frontend', 'errors' => $errors, 'mark' => true));

	echo App_Formtb::input('per_page_backend', $data['per_page_backend'], NULL,
		array('label' => 'publications.article.per_page_backend', 'errors' => $errors, 'mark' => true));

	echo App_Formtb::btns();

echo Form::close();

?>

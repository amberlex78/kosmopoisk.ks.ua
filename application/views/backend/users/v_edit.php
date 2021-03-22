<?php defined('SYSPATH') or die('No direct script access.');

echo Form::open(Request::current(), array('class'=>'form-horizontal'));

	echo App_Formtb::input('username', $o_user->username,
		array('class' => 'input'),
		array('label' => 'users.login', 'errors' => $errors)
	);
	echo App_Formtb::input('password', '',
		array('class' => 'input'),
		array('label' => 'users.password_new', 'errors' => $errors)
	);

	echo App_Formtb::btns();

echo Form::close();

?>
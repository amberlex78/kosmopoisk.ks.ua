<?php defined('SYSPATH') or die('No direct script access.');

echo Form::open(Request::current(), array('class'=>'form-horizontal'));

	echo App_Formtb::input('sitename', $data['sitename'],
		array('class' => 'span7'),
		array('label' => 'settings.sitename', 'help' => 'settings.sitename_h', 'mark' => TRUE, 'errors' => $errors)
	);
	echo App_Formtb::input('siteslogan', $data['siteslogan'],
		array('class' => 'span7'),
		array('label' => 'settings.siteslogan', 'help' => 'settings.siteslogan_h')
	);
	echo App_Formtb::input('sitecopy', $data['sitecopy'],
		array('class' => 'span7'),
		array('label' => 'settings.sitecopy', 'help' => 'settings.sitecopy_h')
	);
	echo App_Formtb::input('autograph', $data['autograph'],
		array('class' => 'span7'),
		array('label' => 'settings.autograph', 'help' => 'settings.autograph_h')
	);
	echo App_Formtb::textarea('meta_d', $data['meta_d'],
		array('class' => 'span7', 'rows' => 2),
		array('label' => 'seo.meta_d', 'help' => 'seo.meta_d_site_h')
	);
	echo App_Formtb::textarea('meta_k', $data['meta_k'],
		array('class' => 'span7', 'rows' => 2),
		array('label' => 'seo.meta_k', 'help' => 'seo.meta_k_site_h')
	);
	echo App_Formtb::input('email', $data['email'],
		array('class' => 'input-xlarge'),
		array('label' => 'settings.email', 'help' => 'settings.email_h', 'errors' => $errors)
	);

	echo App_Formtb::btns();

echo Form::close();

?>
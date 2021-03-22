<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
	'driver'       => 'ORM',
	'hash_method'  => 'sha256',

	// Генерим здесь: https://www.grc.com/passwords.htm
	'hash_key'     => 'jN7sCnx2goVPJfxLhclSzrgWeRPzARMbl4d5XpQipy2GJZV2GKwfSPCT85VISne',

	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',
);
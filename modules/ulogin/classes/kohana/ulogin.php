<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Ulogin {
	
	protected $config = array(
		// ��������� ��������: small, panel, window
		'type' 			=> 'panel',
		
		// �� ����� ����� ����� POST-������ �� uLogin
		'redirect_uri' 	=> NULL,
		
		// �������, ��������� �����
		'providers'		=> array(
			'vkontakte',
			'facebook',
			'twitter',
			'google',
		),
		
		// ��������� ��� ���������
		'hidden' 		=> array(
			'odnoklassniki',
			'mailru',
			'livejournal',
			'openid'
		),
		
		// ��� ���� ������������ ��� �������� ���� username � ������� users
		'username' 		=> array (
			'first_name',
		),
		
		// ������������ ����
		'fields' 		=> array(
			'email',
		),
		
		// �������������� ����
		'optional'		=> array(),
	);
	
	protected static $_used_id = array();
	
	public static function factory(array $config = array())
	{
		return new Ulogin($config);
	}
	
	public function __construct(array $config = array())
	{
		$this->config = array_merge($this->config, Kohana::$config->load('ulogin')->as_array(), $config);
		
		if ($this->config['redirect_uri'] === NULL)
			$this->config['redirect_uri'] = Request::initial()->url(true);
	}
	
	public function render()
	{	
		$params = 	
			'display='.$this->config['type'].
			'&fields='.implode(',', array_merge($this->config['username'], $this->config['fields'])).
			'&providers='.implode(',', $this->config['providers']).
			'&hidden='.implode(',', $this->config['hidden']).
			'&redirect_uri='.$this->config['redirect_uri'].
			'&optional='.implode(',', $this->config['optional']);
		
		$view = View::factory('ulogin/ulogin')
					->set('cfg', $this->config)
					->set('params', $params);
		do
		{
			$uniq_id = "uLogin_".rand();
		}
		while(in_array($uniq_id, self::$_used_id));
		
		self::$_used_id[] = $uniq_id;
		
		$view->set('uniq_id', $uniq_id);
		
		return $view->render();
	}
	
	public function __toString()
	{
		try
		{
			return $this->render();
		}
		catch(Exception $e)
		{
			Kohana_Exception::handler($e);
			return '';
		}
	}
	
	public function login()
	{
		if (empty($_POST['token']))
			throw new Kohana_Exception('Empty token.');
			
		if (!($domain = parse_url(URL::base(), PHP_URL_HOST)))
		{
			$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
		}
		
		$s = Request::factory('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $domain)->execute()->body();
		$user = json_decode($s, true);
				
		$ulogin = ORM::factory('ulogin', array('identity' => $user['identity']));
		
		if (!$ulogin->loaded())
		{
			if (($orm_user = Auth::instance()->get_user()))
			{
				$user['user_id'] = $orm_user->id;
				$ulogin->values($user, array(
					'user_id',
					'identity',
					'network',
				))->create();
			}
			else
			{
				$data['username'] = '';
				foreach($this->config['username'] as $part_of_name)
					$data['username'] .= (empty($user[$part_of_name]) ? '' : (' '.$user[$part_of_name]));
				
				$data['username'] = trim($data['username']);
				
				if (!$data['username'])
					throw new Kohana_Exception('Username fields not set in config/ulogin.php');
					
				$data['password'] = md5('ulogin_autogenerated_password'.microtime(TRUE));
				
				$cfg_fields = array_merge($this->config['fields'], $this->config['optional']);
				foreach($cfg_fields as $field)
				{
					if (!empty($user[$field]))
						$data[$field] = $user[$field];
				}
							
				$orm_user = ORM::factory('user')->values($data);
				$orm_user->create();
				$orm_user->add('roles', ORM::factory('role', array('name' => 'login')));
				
				$user['user_id'] = $orm_user->id;
				
				$ulogin->values($user, array(
					'user_id',
					'identity',
					'network',
				))->create();
				
				Auth::instance()->force_login($orm_user);
			}
		}
		else
		{
			Auth::instance()->force_login($ulogin->user);
		}
	}
	
	public function mode()
	{
		return !empty($_POST['token']);
	}
}
<?php defined('SYSPATH') OR die('No Direct Script Access');

class Model_User extends ORM
{
	protected static $sSalt = 'mike.local';

	public function rules()
	{
		return array(
			'first_name' => array(
				array('not_empty'),
				array('min_length', array(':value', '2')),
				array('max_length', array(':value', '50')),
			),
			'last_name' => array(
				array('not_empty'),
				array('min_length', array(':value', '2')),
				array('max_length', array(':value', '50')),
			),
			'username' => array(
				array('not_empty'),
				array('min_length', array(':value', '4')),
				array('max_length', array(':value', '50')),
				array(array($this, 'check_username')),
			),
			'password' => array(
				array('not_empty'),
			),
		);
	}

	public function filters()
	{
		return array(
			'first_name' => array(
				array(array($this, 'proper_name'))
			),
			'last_name' => array(
				array(array($this, 'proper_name'))
			),
			'password' => array(
				array(array($this, 'create_hash'))
			),
		);
	}

	public function check_username( $sUsername )
	{
		return !ORM::factory('user', array('username' => $sUsername))->loaded();
	}

	public function create_hash( $sPassword = '' )
	{
		if( empty($sPassword) )
		{
			return '';
		}	
		return md5($sPassword.self::$sSalt);
	}

	public function proper_name( $sName )
	{
		return ucfirst(strtolower($sName));
	}
}
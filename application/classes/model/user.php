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
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'check_email')),
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

	public function check_email( $sEmail )
	{
		return !ORM::factory('user', array('email' => $sEmail))->loaded();
	}

	public function create_hash( $sPassword = '' )
	{
		if( empty($sPassword) )
		{
			return '';
		}
		$oBonafide = Bonafide::instance();
		return $oBonafide->hash($sPassword);
	}

	public function proper_name( $sName )
	{
		return ucfirst(strtolower($sName));
	}
}
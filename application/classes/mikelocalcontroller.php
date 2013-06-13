<?php defined('SYSPATH') or die('No Direct Script Access');

class Mikelocalcontroller extends MMController
{
	protected $bLoginRequired = false;
	protected $bLoggedIn = false;
	protected $aUserData = array();

	public function before()
	{
		if( $this->bLoginRequired )
		{
			if( !Simpleauth::instance()->logged_in() )
			{
				$this->request->redirect('/voorpagina/inloggen');
			}
			else
			{
				$this->bLoggedIn = true;
				$this->aUserData = ORM::factory('user', $_SESSION['kohana_user']['id'])->as_array();

			}
		}

		parent::before();

		$this->template->set('logged_in', $this->bLoggedIn);
		$this->template->set('userdata', $this->aUserData);
	}
}
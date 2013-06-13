<?php defined('SYSPATH') OR die('No Direct Script Access');

class Controller_Voorpagina extends Mikelocalcontroller
{
	protected $bLoginRequired = false;

	public function action_index()
	{
		$this->data['view_main'] = 'pages/voorpagina';
	}

	public function action_registreren()
	{
		$aValues = array();
		$aErrors = array();

		if( HTTP_Request::POST === $this->request->method() )
		{
			$oUser = ORM::factory('user');
			$oUser->values($_POST);

			try
			{
				$oUser->save();

				Simpleauth::instance()->login($_POST['username'],$_POST['password']);

				if(Simpleauth::instance()->logged_in())
				{
					$this->request->redirect('/beveiligd/', array('first_login'=>true));
				}
			}
			catch( ORM_Validation_Exception $oException )
			{
				$aErrors = $oException->errors('models');
			}
		}
		
		$this->data['view_main'] = 'pages/registreren';
		
		$this->template->set('aValues', $_POST);
		$this->template->bind('aErrors', $aErrors);
		
		$aFields = array(
			'first_name' => 'Voornaam',
			'last_name' => 'Achternaam',
			'email' => 'Emailadres',
			'username' => 'Gebrukersnaam',
			'password' => 'Wachtwoord',
		);

		$this->template->set('aFormFields', $aFields);
		
	}

	public function action_inloggen()
	{
		$this->data['show_login_failure_notice'] = false;
		$aValues = array();
		$aErrors = array();

		if( HTTP_Request::POST === $this->request->method() )
		{
			Simpleauth::instance()->login($_POST['username'],$_POST['password']);
			if(Simpleauth::instance()->logged_in())
			{
				$this->request->redirect('/beveiligd/');
			}
			else
			{
				$this->data['show_login_failure_notice'] = true;
			}
		}
		
		$this->data['view_main'] = 'pages/inloggen';
		$aFields = array(
			'username' => 'Gebrukersnaam of email',
			'password' => 'Wachtwoord',
		);

		$this->template->set('aFormFields', $aFields);
	}

	public function action_uitloggen()
	{
		$this->data['show_logged_out_notice'] = false;
		$this->data['show_not_logged_in_notice'] = false;

		if( Simpleauth::instance()->logged_in() )
		{
			Simpleauth::instance()->logout();
			$this->data['show_logged_out_notice'] = true;
		}
		else
		{
			$this->data['show_not_logged_in_notice'] = true;
		}

		$this->data['view_main'] = 'pages/uitloggen';
	}

	public function action_test()
	{
		echo " test actie ";
	}
}
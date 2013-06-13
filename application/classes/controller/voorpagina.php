<?php defined('SYSPATH') OR die('No Direct Script Access');

class Controller_Voorpagina extends MMController
{
	public function action_index()
	{
		$this->data['view_main'] = 'pages/voorpagina';
		exit;
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

				echo "saved";
				// All good? Add user and redirect to /beveiligd/
			}
			catch( ORM_Validation_Exception $oException )
			{
				$aErrors = $oException->errors('models');
			}
		}
		
		$this->data['view_main'] = 'pages/registreren';
		
		$this->template->set('aValues', $_POST);
		$this->template->bind('aErrors', $aErrors);
	}
}
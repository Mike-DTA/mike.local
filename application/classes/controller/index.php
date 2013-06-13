<?php defined('SYSPATH') OR die('No Direct Script Access');

class Controller_Index extends MMController
{
	public function action_index()
	{
		$this->request->redirect('/voorpagina/');
	}
}
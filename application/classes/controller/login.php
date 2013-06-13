<?php defined('SYSPATH') or die('No Direct Script Access');

class Controller_Login extends MMController
{
	public function before()
	{ 
		parent::before();
		var_dump($this->request->controller());
		var_dump($this->request->action());
		var_dump($this->request->param());
	}

	public function action_index()
	{
		echo "index"; 
	}

	public function action_test()
	{
		echo "test";
	}
}
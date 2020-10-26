<?php

namespace App\Core;
use Delight\Auth\Auth;

class Controller
{
	public $view;
	public $auth;
	
	function __construct()
	{
		$this->view = new View();
		$this->auth = new Auth(Model::getDbInstance());
	}
}
?>
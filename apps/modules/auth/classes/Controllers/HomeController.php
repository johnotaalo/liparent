<?php

namespace LIPARENT\Auth\Controllers;

use LIPARENT\Common\Controllers\BaseController;
use Phalcon\Mvc\Controller;

class HomeController extends BaseController
{

	public function indexAction()
	{
		// $this->response->redirect('auth/user/signin');
		$this->reroute();
		//echo ' Welcome Reporting Module Controller Home Action Index ';
		//echo '<br>', __METHOD__;
		
	}

}

<?php

namespace LIPARENT\Tenant\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Common\Models\TenantHouseV as TenantHouse;

class HomeController extends Controller{
	public function indexAction(){
		$tenantHouseDetails = TenantHouse::findFirstByTenantUserId($this->session->get('user_id'));

		$variables = [
			'house_details' => $tenantHouseDetails
		];
		$this->view->content = $this->_view
		->setVars($variables)
		->getPartial('home');
	}
}
<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
// use LIPARENT\Superadmin\Models\User;
// use LIPARENT\Superadmin\Models\UserGroup;
// use LIPARENT\Superadmin\Models\UserGroupMap;


class UserController extends Controller
{
	
	public function indexAction()
	{
		$this->view->content = $this->_view
								->getPartial('default');

		$custom_js = $this->_view->getPartial('partials/default_javascript');

		$this->addJavaScript($custom_js);
	}

	public function viewAction()
	{
		$this->view->content = $this->_view
								->getPartial('users');
	
		// Add some local CSS resources
        $this->assets
            ->addCss('vendors/datatables/dataTables.bootstrap.css');

        // And some local JavaScript resources
        $this->assets
            ->addJs('vendors/datatables/jquery.dataTables.min.js')
            ->addJs('vendors/datatables/dataTables.bootstrap.min.js');

		
		$custom_js = $this->_view->getPartial('partials/users_javascript');

		$this->addJavaScript($custom_js);
	}

	public function viewusersAction()
	{
		
	}
}
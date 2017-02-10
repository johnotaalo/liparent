<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Common\Models\UserView as Users;
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
		$variables = [
			"users_table"	=>	$this->createUsersTable()
		];

		$this->view->content = $this->_view
								->setVars($variables)
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

	public function createUsersTable(){
		$users = Users::find();
		$table = "";
		if (count($users)) {
			$counter = 1;
			foreach ($users as $user) {
				$status = ($user->user_active == 1) ? '<label class = "circle green"></label> <label>Active</label>' : '<label class = "circle red"></label> Inactive';
				$table .= "<tr>";
				$table .= "<td>$counter</td>";
				$table .= "<td>$user->emailaddress</td>";
				$table .= "<td>$user->user_group</td>";
				$table .= "<td>$status</td>";
				$table .= "</tr>";

				$counter++;
			}
		}

		return $table;
	}

	public function viewusersAction()
	{
		
	}
}
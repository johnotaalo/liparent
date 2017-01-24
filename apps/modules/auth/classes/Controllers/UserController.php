<?php

namespace LIPARENT\Auth\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;

use \LIPARENT\Auth\Models\User;
use \LIPARENT\Auth\Models\UserGroupMap;
use \LIPARENT\Auth\Models\UserGroup;

class UserController extends Controller
{
	public function indexAction()
	{
		$this->signinAction();
	}

	public function signinAction()
	{
		if(!$this->request->getPost())
		{
			$this->view->content = $this->_view
									->getPartial('signin');

			$custom_js = $this->_view->getPartial('partials/auth_javascript');
			$this->addJavaScript($custom_js);
		}
		else
		{
			// echo "yoooooooh";die;

			if($this->security->checkToken())
			{
				$password = $this->request->getPost('password');
				$user = User::findFirst("username = '{$this->request->getPost('username')}'");

				if ($user) 
				{
					if ($this->security->checkHash($password, $user->password)) 
					{
						$user_groups_map = UserGroupMap::find("user_id = {$user->id}");
						if ($user_groups_map)
						{
							$logged_in_usergroups = array();

							$landlord_username = \LIPARENT\Auth\Models\User::get_loggedin_landlord($user->id);
							$tenant_username = \LIPARENT\Auth\Models\User::get_loggedin_tenant($user->id);
							$admin_username = \LIPARENT\Auth\Models\User::get_loggedin_admin($user->id);

							$username = "";
							$do = 1;



							if(count($landlord_username))
							{
								$username = $landlord_username[0]['name'];
							}
							elseif(count($tenant_username)) 
							{
								$username = $tenant_username[0]['name'];
							}
							elseif(count($admin_username))
							{
								$username = $admin_username[0]['name'];
							}
							// echo "<pre>";print_r($username);die;

							$this->session->set("user_id", $user->id);
							$this->session->set("username", $username);
							$this->session->set("logged_in", true);

							foreach ($user_groups_map as $mapping)
							{
								$user_group = UserGroup::findFirst("id = {$mapping->usergroup_id}")->name;
								$logged_in_usergroups[] = $user_group;
							}
							
							$this->session->set("user_groups", $logged_in_usergroups);
							$this->session->set("selected_usergroup", $logged_in_usergroups[0]);
							$this->reroute();
						
						}
					}
					else
					{
						$this->security->hash(rand());
						$this->flashSession->error("The password you entered was wrong");
						$this->response->redirect("auth/user");
					}
				}
				else
				{
					$this->security->hash(rand());
					$this->flashSession->error("The username you entered does not exist");
					$this->response->redirect("auth/user");
				}
			}
			else
			{
				$this->security->hash(rand());
				$this->response->redirect("auth/user");
			}
		}
		
	}

	function switchuserAction($key)
	{
		$logged_in_usergroups = $this->session->get("user_groups");
		$this->session->set("selected_usergroup", $logged_in_usergroups[$key]);
		$this->reroute();
	}

	function addUser($firstname = NULL, $surname = NULL, $username = NULL , $user_type = NULL , $email = NULL, $password = NULL)
	{
		if ($firstname == NULL && $surname == NULL && $username == NULL && $email == NULL && $password == NULL) {
			$firstname = $this->request->getPost('firstname');
			$surname = $this->request->getPost('surname');
			$username = $this->request->getPost('username');
			$email = $this->request->getPost('email_address');
			$password = $this->request->getPost('password');
		}

		$user_type = ($this->request->getPost('user_type_id')) ? $this->request->getPost('user_type_id') : $user_type;
		$user = new User();

		$user->firstname = $firstname;
		$user->surname = $surname;
		$user->username = $username;
		$user->email = $email;
		$user->password = $this->security->hash($password);
		// echo "<pre>";print_r($user);die;
		$user->save();

		$user_id = $user->id;


		if (is_array($user_type))
		{
			foreach ($user_type as $type) {
				$user_group_map = new UserGroupMap();

			$user_group_map->usergroup_id = $type;
			$user_group_map->user_id = $user_id;

			if ($user_group_map->save() == false) {
				echo "Umh, We can't store product: ";
				foreach ($user_group_map->getMessages() as $message) {
					echo $message;
					}die;
				}
			}
			
		}
		else
		{
			$user_group_map = new UserGroupMap();
			// echo "noooo";die;
			$user_group_map->usergroup_id = $user_type;
			$user_group_map->user_id = $user_id;
			// echo "<pre>";print_r($user_group_map);die;
			if ($user_group_map->save() == false) {
				echo "Umh, We can't store product: ";
				foreach ($user_group_map->getMessages() as $message) {
					echo $message;
				}die;
			} 
			else 
			{
				return true;
			}
		}
		// add send email functionality
	}


	function signoutAction()
	{
		$this->session->destroy();

		$this->response->redirect("auth/user/signin");
	}
}
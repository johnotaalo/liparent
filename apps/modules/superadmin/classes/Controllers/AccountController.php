<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Superadmin\Models\User;
use LIPARENT\Superadmin\Models\Contact;
use LIPARENT\Superadmin\Models\Tenant;

class AccountController extends Controller
{
	public function profileAction()
	{
		$flash = 0;
		$messages = $this->flashSession->getMessages();
		if ( count($messages) > 0) {
			foreach ($messages as $messageType => $messageArray) {
	                    foreach ($messageArray as $message) {
	                        // echo $message;die;
	                        $flash = $message;
	                        // echo $flash;die;
	                    }
	                }
        }

		$userid = $this->session->get('user_id');
		$username = $this->session->get('username');
		$role = $this->session->get("selected_usergroup");

		$user = User::findfirst("id = {$userid}");
		$contacts = Contact::find("user_id = {$userid}");
		$timestamp = strtotime($user->created);
		$date = date("d-m-Y", $timestamp);
		$user_contacts = array();
		// $this->view->disable();

		// echo "<pre>";print_r($contacts);die;
		foreach ($contacts as $key => $value) 
		{
			// echo "<pre>";print_r($value->contact);
			$user_contacts[] = $value->contact;
		}

		// echo "<pre>";print_r($user_contacts);die;

		$variables = array(
				'username' => $username, 
				'role' => $role,
				'date' => $date,
				'user_contacts' => $user_contacts
			);


		$this->view->content = $this->_view
								->setVars($variables)
								->setParamToView('flash', $flash)
								->getPartial('profile');
		
		$custom_js = $this->_view->getPartial('partials/profile_javascript');

		$this->addJavaScript($custom_js);
	}

	public function updateprofileAction($userid, $type)
	{
		if($this->request->isPost())
		{
			if ($type == "contacts") 
			{
				# code...
			}
			else
			{
				// echo "<pre>";print_r($this->request->getPost());die;
				$email = $this->request->getPost('curremail');
				$currentpass = $this->request->getPost('currpass');
				$newpass = $this->request->getPost('newpass');

				$user = User::findfirst("id = {$userid}");

				if($user)
				{
					if($this->security->checkHash($currentpass, $user->password))
					{
						$user->password = $this->security->hash($newpass);
						$user->update();
						
						$tenant = Tenant::findfirst("user_id = {$userid}");
						$tenant->active = 1;
						$tenant->update();

						$contact = Contact::find("user_id = {$userid}");
						$contact->active = 1;
						$contact->update();

						$this->flashSession->success("Password successfully changed");
						$this->response->redirect("superadmin/account/profile");
					}
					else
					{
						$this->security->hash(rand());
				        $this->flashSession->error("The passwords don't match");
				        $this->response->redirect("superadmin/account/profile");
					}
				}
				else
				{
					$this->security->hash(rand());
					$this->flashSession->error("The password you entered was wrong");
					$this->response->redirect("superadmin/account/profile");
				}
			}
		}
		else
		{
			$this->response->redirect("superadmin/account/profile");
		}
	}
}

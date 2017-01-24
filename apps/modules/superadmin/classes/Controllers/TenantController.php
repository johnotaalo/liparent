<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Superadmin\Models\User;
use LIPARENT\Superadmin\Models\UserGroup;
use LIPARENT\Superadmin\Models\UserGroupMap;
use LIPARENT\Superadmin\Models\Tenant;
use LIPARENT\Superadmin\Models\Contact;


class TenantController extends Controller
{
	public function viewAction()
	{
		$this->view->content = $this->_view
								->getPartial('tenants');
	
		// Add some local CSS resources
        $this->assets
            ->addCss('vendors/datatables/dataTables.bootstrap.css');

        // And some local JavaScript resources
        $this->assets
            ->addJs('vendors/datatables/jquery.dataTables.min.js')
            ->addJs('vendors/datatables/dataTables.bootstrap.min.js');

		
		$custom_js = $this->_view->getPartial('partials/tenants_javascript');

		$this->addJavaScript($custom_js);
	}

	public function viewtenantsAction()
	{
		
	}

	function addtenant($idno = NULL, $firstname = NULL, $surname = NULL, $phone = NULL, $email = NULL, $username = NULL, $password = NULL, $usertype = NULL)
	{
		if ($idno == NULL && $firstname == NULL && $surname == NULL && $phone == NULL && $email == NULL && $username == NULL && $password == NULL) 
		{
			$idno = $this->request->getPost('idno');
			$firstname = $this->request->getPost('firstname');
			$surname = $this->request->getPost('surname');
			$phone = $this->request->getPost('phone');
			$email = $this->request->getPost('email');

			//generating credentials
			$username_string = $this->request->getPost('firstname');
			$generated_username = $username_string[0] . $surname ;

			$username = strtolower($generated_username);
			// echo $generated_username;die;

			$random = new \Phalcon\Security\Random();
			$randompassword = $random->base64Safe(4);
			// echo $randompassword;die;
		}

		$validemail = Contact::findFirst("contact = '{$this->request->getPost('email')}' ");

		if($validemail == "")
		{
			$usertype = ($this->request->getPost('usertype_id')) ? $this->request->getPost('usertype_id') : $usertype;
			$user = new User();

			$user->username = $username;
			$user->password = $this->security->hash($randompassword);
			// echo "<pre>";print_r($user);die;

			$user->save();

			$user_id = $user->id;

			if (is_array($usertype))
			{
				foreach ($usertype as $type) {
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
				$user_group_map->usergroup_id = $usertype;
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
					$tenant = new Tenant();

					$tenant->user_id = $user_id;
					$tenant->id_number = $idno;
					$tenant->first_name = $firstname;
					$tenant->surname = $surname;
					// echo "<pre>";print_r($tenant);die;

					$tenant->save();

					$contacts = array();

					if (!$phone == "") 
					{
						$contacts[] = array(
							'contact' => $phone,
							'type' => 'phone'
							);

						$tenant_contact = new Contact();
						$tenant_contact->user_id = $user_id;
						$tenant_contact->contact = $phone;
						$tenant_contact->type = 'phone';

						$tenant_contact->save();
					}

					if (!$email == "") 
					{
						$contacts[] = array(
							'contact' => $email,
							'type' => 'email'
							);

						$tenant_contact = new Contact();
						$tenant_contact->user_id = $user_id;
						$tenant_contact->contact = $email;
						$tenant_contact->type = 'email';

						$tenant_contact->save();
					}

					// $this->view->disable();
					//send email here
					$subject = 'Lipa Rent System Account Registration';
					$this->getDI()->getMail()->send(
					array(
						$email => $surname." ".$firstname
					),
						$subject,
						'tenant_registration',
						array(
						'name' => $surname." ".$firstname,
						'username' => $username,
						'password' => $randompassword
						)
					);

					return $tenant->id;
				}
			}
		}
		else
		{
			$this->flashSession->error("The email is already registered");
			$this->response->redirect("superadmin/tenant/add");
		}
	}

	public function addAction($type="html")
	{
		if(!$this->request->getPost())
		{
			if ($type == "json") 
			{
				$response   = new \Phalcon\Http\Response();
				$addtenantpage = $this->view->content = $this->_view
										->getPartial('addtenant');

				$addtenantpage = array(
				  'page' => $addtenantpage,
				);

				return $response->setJsonContent($addtenantpage);
			}
			else
			{
				$this->view->content = $this->_view
									->getPartial('addtenant');
				$custom_js = $this->_view->getPartial('partials/tenants_javascript');
				$this->addJavaScript($custom_js);
			}
			
		}
		else
		{
			// echo "<pre>";print_r($this->request->getPost());die;
			$tenantadded_json = '';
			$tenant_id = $this->addtenant(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
			$this->view->disable();
			if ($tenant_id) 
			{
				$tenantadded = array(
					'type' => "success",
					'message'=> "Tenant successfully added",
					'tenant_id' => $tenant_id,
				);
				$tenantadded_json = json_encode($tenantadded);
				$_POST = array();

				echo $tenantadded_json;exit;
			}

			
		}
	}
}
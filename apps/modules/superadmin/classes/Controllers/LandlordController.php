<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Superadmin\Models\User;
use LIPARENT\Superadmin\Models\UserGroup;
use LIPARENT\Superadmin\Models\UserGroupMap;
use LIPARENT\Superadmin\Models\Landlord;
use LIPARENT\Superadmin\Models\Contact;

class LandlordController extends Controller
{
	function addlandlord($idno = NULL, $firstname = NULL, $surname = NULL, $phone = NULL, $email = NULL, $username = NULL, $password = NULL, $usertype = NULL)
	{
		// $response   = new \Phalcon\Http\Response();
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
			// echo $username;die;

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
					$landlord = new Landlord();

					$landlord->user_id = $user_id;
					$landlord->id_number = $idno;
					$landlord->first_name = $firstname;
					$landlord->surname = $surname;
					// echo "<pre>";print_r($landlord);die;

					$landlord->save();

					$contacts = array();

					if (!$phone == "") 
					{
						$contacts[] = array(
							'contact' => $phone,
							'type' => 'phone'
							);

						$landlord_contact = new Contact();
						$landlord_contact->user_id = $user_id;
						$landlord_contact->contact = $phone;
						$landlord_contact->type = 'phone';

						$landlord_contact->save();
					}

					if (!$email == "") 
					{
						$contacts[] = array(
							'contact' => $email,
							'type' => 'email'
							);

						$landlord_contact = new Contact();
						$landlord_contact->user_id = $user_id;
						$landlord_contact->contact = $email;
						$landlord_contact->type = 'email';

						$landlord_contact->save();
					}

					// $this->view->disable();
					//send email here
					$subject = 'Lipa Rent System Account Registration';
					$this->getDI()->getMail()->send(
					array(
						$email => $surname." ".$firstname
					),
						$subject,
						'landlord_registration',
						array(
						'name' => $surname." ".$firstname,
						'username' => $username,
						'password' => $randompassword
						)
					);

					return true;
				}
			}
		}
		else
		{
			$this->flashSession->error("The email is already registered");
			$this->response->redirect("superadmin/landlord/add");
		}
	}

	public function addAction()
	{
		// $response   = new \Phalcon\Http\Response();
		$landlordadded_json = '';
		if($this->request->getPost())
		{
			// echo "<pre>";print_r($this->request->getPost());die;
			$success = $this->addlandlord(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);
			if ($success) 
			{
				$landlordadded = array(
					'type' => "success",
					'message'=> "Landlord successfully added",
				);
				$landlordadded_json = json_encode($landlordadded);
				$_POST = array();
				// return $response->setJsonContent($landlordadded);
			}
		}

		$this->view->content = $this->_view
									->setParamToView('landlordadded_json', $landlordadded_json)
									->getPartial('addlandlord');
		/*$this->assets
            ->addCss('plugins/datatables/dataTables.bootstrap.css')*/
									
		$custom_js = $this->_view->getPartial('partials/landlords_javascript');
		$this->addJavaScript($custom_js);

	}

	public function viewAction()
	{
		$this->view->content = $this->_view
								->getPartial('landlords');
	
		// Add some local CSS resources
        $this->assets
            ->addCss('vendors/datatables/dataTables.bootstrap.css');

        // And some local JavaScript resources
        $this->assets
            ->addJs('vendors/datatables/jquery.dataTables.min.js')
            ->addJs('vendors/datatables/dataTables.bootstrap.min.js');

		
		$custom_js = $this->_view->getPartial('partials/landlords_javascript');

		$this->addJavaScript($custom_js);
	}

	public function viewlandlordsAction()
	{
		
	}
}
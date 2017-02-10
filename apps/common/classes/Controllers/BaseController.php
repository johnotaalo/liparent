<?php
namespace LIPARENT\Common\Controllers;
error_reporting(E_ALL);
ini_set('display_errors', 1);
use Phalcon\Mvc\Controller;


class BaseController extends Controller
{
	private $javascript = array();

	public function addJavaScript($script)	
    {
    	
    	array_push($this->javascript, $script);
    	$this->view->javascript = $this->javascript;

    }

    public function getJavaScript()
    {
    	return $this->javascript;
    }	

    public function initialize()
    {
      // $this->view->disable();
    	\Phalcon\Tag::setTitle("Lipa Rent Portal");
      	$this->view->javascript = $this->javascript;

        $module = $this->router->getModuleName();
          if($module != "auth")
          {

            if ($this->session->has("logged_in")) {
             
              $this->view->username = $this->session->get('username');
              $user_module_access = [
                'superadmin' => ["Super Admin"],
                'landlord' => ["Landlord"],
                'tenant' => ["Tenant"],
                'admin' => ["Admin"],

              ];
              $user_group = $this->session->get("selected_usergroup");

              // echo "<pre>";print_r($module);die;

              if(in_array($user_group, $user_module_access[$module]))
              {
                switch ($module) {
                  case 'superadmin':
                    $this->view->sidebar = $this->commonsections->getPartial('superadmin_sidebar');
                    break;
                  case 'landlord':
                   $this->view->sidebar = $this->view->getPartial('sections/landlord_sidebar');
                    break;
                  case 'tenant':
                    // $this->view->sidebar = $this->view->getPartial('tenant_sidebar');
                    break;
                  case 'admin':
                   $this->view->sidebar = $this->view->getPartial('sections/admin_sidebar');
                    break;
                  default:
                     // $this->view->disable();
                  break;
                }
              }
              else
              {
                $this->view->disable();
                $this->response->setStatusCode(401, "Access Denied");
                $this->response->setContent("<center><h1>You are not allowed to view this page</h1></center>");

                // Send response to the client
                $this->response->send();
              }
            }
            else
            {
              $this->response->redirect("auth/user/signin");
            }
          }
          else
          {
            // $this->reroute();
            // $this->response->redirect("auth/user/signin");
            $controller = $this->router->getControllerName();
            $action = $this->router->getActionName();

            // echo $module;die;
          }
          
          $this->flashSession->setCssClasses(
            [
              'error'   => 'alert alert-danger alert-dismissable',
              'success' => 'alert alert-success alert-dismissable',
              'notice'  => 'alert alert-info alert-dismissable',
              'warning' => 'alert alert-warning alert-dismissable'
            ]
          );

          // $this->response->redirect("auth/user/signin");
        }

      public function reroute()
      {
        if ($this->session->has("logged_in")) {

          
          $user_group = $this->session->get("selected_usergroup");
          // echo $user_group;die;

          if($user_group == "Super Admin"){
            $this->response->redirect("superadmin/user/index");
          }
          else if($user_group == "Landlord"){
            $this->response->redirect("landlord/dashboard/index");
          }
          else if($user_group == "Tenant"){
            $this->response->redirect("superadmin/user/index");
          }
          else if($user_group == "Admin"){
            $this->response->redirect("admin/dashboard/index");
          }
          else{
            echo "User group does not exist";
          }
        }
        else 
        {
          $this->response->redirect("auth/user/signin");
        }
      }

      public function usergroupslist()
      {
        $usergroups = $this->session->get("user_groups");
        $selected_usergroup = $this->session->get("selected_usergroup");
        $usergroup_list = "";

        if (count($usergroups) > 1) 
        {
          foreach ($usergroups as $key => $usergroup) 
          {
            
            if ($usergroup != $selected_usergroup) 
            {
              $usergroup_list .= "<p><li><a href='" . $this->url->get("auth/user/switchuser/$key") . " '>Login as " . $usergroup ." </a></li><p>";
            }
          }

          return $usergroup_list;
        }
      }
}
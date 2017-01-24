<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Superadmin\Controllers\TenantController as TenantCtrl;
use LIPARENT\Superadmin\Models\Currency;
use LIPARENT\Superadmin\Models\Landlord;
use LIPARENT\Superadmin\Models\House;
use LIPARENT\Superadmin\Models\Tenant;


class HouseController extends Controller
{
	function addhouse($type = NULL, $latitude = NULL, $longitude = NULL, $estate = NULL, $block = NULL, $floor = NULL, $house_no = NULL, 
								   $rent = NULL, $currencyid = NULL, $facilities = NULL, $landlordid = NULL)
	{
		if ($type == NULL && $latitude == NULL && $longitude == NULL && $estate == NULL && $block == NULL && $floor == NULL && $house_no == NULL && 
			$rent == NULL && $currencyid == NULL && $facilities == NULL && $landlordid == NULL) 
		{
			$type = $this->request->getPost('housetype');
			$latitude = $this->request->getPost('latitude');
			$longitude = $this->request->getPost('longitude');
			$estate = $this->request->getPost('estate');
			$block = $this->request->getPost('block');
			$floor = $this->request->getPost('floor');
			$house_no = $this->request->getPost('house_no');
			$rent = $this->request->getPost('rentamount');
			$currencyid = $this->request->getPost('currency_id');
			$facilities = $this->request->getPost('facilities');
			$landlordid = $this->request->getPost('landlord_id');
		}

		$house = new House();

		$house->type = $type;
		$house->longitude = $longitude;
		$house->latitude = $latitude;
		$house->estate_name = $estate;
		$house->block = $block;
		$house->floor = $floor;
		$house->house_no = $house_no;
		$house->rent_amount = $rent;
		$house->currency_id = $currencyid;
		$house->facilities = $facilities;
		$house->landlord_id = $landlordid;
		// echo "<pre>";print_r($house);die;

		$house->save();

		return true;

		// echo "<pre>";print_r($house);die;
	}

	public function addAction()
	{
		$houseadded_json = '';
		if($this->request->getPost())
		{
			echo "<pre>";print_r($this->request->getPost());die;
			$success = $this->addhouse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
			if ($success) 
			{
				$houseadded = array(
					'type' => "success",
					'message'=> "House has successfully been added",
				);
				$houseadded_json = json_encode($houseadded);
				$_POST = array();
				// return $response->setJsonContent($landlordadded);
			}
		}

		$currency = Currency::find();
		$landlords = Landlord::find();

		// echo "</pre>";print_r($currency);die;

		$currency_string = '';
		foreach ($currency as $key => $value) 
		{
			$currency_string .= "<option value='". $value->id ." '> ". $value->initials ."</option>";
		}


		$landlords_string = '';
		$landlord_name = '';
		foreach ($landlords as $key => $value) 
		{
			
			$landlord_name = $value->surname . ", " . $value->first_name;
			// echo "<pre>";print_r($landlord_name);die;
			$landlords_string .= "<option value='". $value->id ."'>". $landlord_name ."</option>";
		}

		$variables = array(
				'currency_select' => $currency_string, 
				'landlords_select' => $landlords_string
			);

		// echo "</pre>";print_r($currency);die;
		// echo "</pre>";print_r($this->request->getPost());die;
		$this->view->content = $this->_view
								->setVars($variables)
								->getPartial('addhouse');
		$this->assets
        	->addCss('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css');

        $this->assets
             ->addJs('vendors/maplace/maplace.min.js')
             ->addJs('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js')
             ->addJs('vendors/bower_components/autosize/dist/autosize.min.js');
									
		$custom_js = $this->_view->getPartial('partials/houses_javascript');
		$this->addJavaScript($custom_js);
	}

	public function testAction()
	{
		$this->view->content = $this->_view
									->getPartial('trying');
		$this->assets
            ->addCss('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css');
        $this->assets
             ->addJs('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js');
									
		$custom_js = $this->_view->getPartial('partials/houses_javascript');
		$this->addJavaScript($custom_js);

	}

	public function listAction()
	{
		$this->view->content = $this->_view
									->getPartial('houses_list');
		$this->assets
            ->addCss('vendors/datatables/jquery.dataTables.css')
            ->addCss('vendors/datatables/dataTables.bootstrap.css');
        $this->assets
             ->addJs('vendors/datatables/jquery.dataTables.min.js');
									
		$custom_js = $this->_view->getPartial('partials/all_houses_javascript');
		$this->addJavaScript($custom_js);
	}

	public function gethousesAction()
	{
		$houses = House::find();
		// echo "<pre>";print_r($houses);die;

		$geolocation = array();
		$houses_data = array();
		$house_type = "";
		$status = "";
		$action = "";

		foreach ($houses as $key => $value) 
		{
			$geolocation = $value->latitude . ',' . $value->longitude;
			$request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false'; 
			$file_contents = file_get_contents($request);
			$json_data = json_decode($file_contents);
			$location = "";
			// echo "<pre>";print_r($json_data->results[0]['formatted_address']);
			if (isset($json_data->results[0])) {
				// echo $json_data->results[0]['formatted_address'];
				foreach ($json_data->results[0] as $k => $v) {
					if ($k == "formatted_address") {
						$location =  $v;
						break;
					}
				}
			}

			$url = $this->url->get("superadmin/house/edit/$value->id");
			$url_ = $this->url->get("superadmin/house/delete/$value->id");
			$_url = $this->url->get("superadmin/house/assign/$value->id");

			if ($value->type == 0)
			{
				$house_type = "Apartment";
			}
			else
			{
				$house_type = "Massionette/Bungalow";
			}

			if ($value->available == 0)
			{
				$status = "<label class='label label-pill label-warning'>Empty</label>";
				$action = "<a href = ''><i class='zmdi zmdi-edit'></i> | <a href = '{$_url}'><i class='zmdi zmdi-account-add'></i></a>";
			}
			else
			{
				$status = "<label class='label label-pill label-success'>Occupied</label>";
				$action = "<a href = ''><i class='zmdi zmdi-edit'></i> | <a data-href = '' ><i class='zmdi zmdi-view-list'></i></a>";
			}

			//creating the table
			$houses_data[] = [
				"<input type = 'checkbox' class='checkbox' name='houseid[]' value='$value->id'><i class='input-helper'></i>",
				$house_type,
				$location,
				$value->estate_name,
				$value->house_no,
				$value->rent_amount,
				$status,
				$action
				];
		}

		echo json_encode($houses_data);die;
	}

	public function assignAction($houseid = NULL)
	{
		if (!$this->request->isPost()) 
		{
			$housedetail = House::findfirst("id = {$houseid}");
			// echo "<pre>";print_r($housedetail);die;
			$geolocation = $housedetail->latitude . ',' . $housedetail->longitude;
			$request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false'; 
			$file_contents = file_get_contents($request);
			$json_data = json_decode($file_contents);
			$location = "";
			// echo "<pre>";print_r($json_data->results[0]);die;
			if (isset($json_data->results[0])) {
				// echo $json_data->results[0]['formatted_address'];
				foreach ($json_data->results[0] as $k => $v) {
					if ($k == "formatted_address") {
						$location =  $v;
						break;
					}
				}
			}

			$house_type = "";
			$available = "";
			if($housedetail->type == 0 )
			{
				$house_type = "Apartment";
			}
			else
			{
				$house_type = "Massionette/Bungalow";
			}

			$variables = array(
					'tenants_string' => $this->returntenantsAction(),
					'house_detail' => $housedetail,
					'house_type' => $house_type,
					'location' => $location
				);

			$this->view->content = $this->_view
								->setVars($variables)
								->getPartial('assign');
			$this->assets
	        	->addCss('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css')
	        	->addCss('vendors/datatables/jquery.dataTables.css')
            	->addCss('vendors/datatables/dataTables.bootstrap.css');

	        $this->assets
	             ->addJs('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js')
	             ->addJs('vendors/datatables/jquery.dataTables.min.js')
	             ->addJs('vendors/bower_components/autosize/dist/autosize.min.js');
										
			$custom_js = $this->_view->getPartial('partials/all_houses_javascript');
			$this->addJavaScript($custom_js);

		}
		else
		{
			
			$tenantid = $this->request->getPost('tenant_id');

			$assigntenant = Tenant::findFirst($tenantid);
			

			$houseid = $this->request->getPost('house_id');

			$fillhouse = House::findFirst($houseid);
			// echo "<pre>";print_r($fillhouse);die;
			$assigntenant->house_id = $houseid;
			$assigntenant->active = 1;
			$fillhouse->available = 1;

			// echo "<pre>";print_r($assigntenant);die;
			$assigntenant->save();
			$fillhouse->save();


		}
	}

	function returntenantsAction($type = "html", $tenant_id = NULL)
	{
		$tenants = Tenant::find();

		$tenants_string = '';

		foreach ($tenants as $key => $value) 
		{
			$selected = "";
			$tenant_name = $value->surname . ", " . $value->first_name;
			// echo "<pre>";print_r($landlord_name);die;
			if ($tenant_id = $value->id) 
			{
				$selected = "selected = 'selected'";
			}
			$tenants_string .= "<option value='". $value->id ."' ". $selected .">". $tenant_name ."</option>";
		}


		if ($type=="json") { $this->view->disable(); echo $tenants_string; } else { return $tenants_string; }
	}


}
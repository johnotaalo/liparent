<?php

namespace LIPARENT\Superadmin\Models;

class House extends \Phalcon\Mvc\Model
{
	protected $id;
	
	protected $type;

	protected $longitude;

	protected $latitude;

	protected $estate_name;

	protected $block;

	protected $floor;

	protected $house_no;

	protected $rent_amount;

	protected $currency_id;

	protected $facilities;

	protected $landlord_id;

	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;

		return $this;
	}

	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;

		return $this;
	}

	public function setEstateName($estate_name)
	{
		$this->estate_name = $estate_name;

		return $this;
	}

	public function setBlock($block)
	{
		$this->block = $block;

		return $this;
	}

	public function setFloor($floor)
	{
		$this->floor = $floor;

		return $this;
	}

	public function setHouseNo($house_no)
	{
		$this->house_no = $house_no;

		return $this;
	}

	public function setRentAmount($rent_amount)
	{
		$this->rent_amount = $rent_amount;

		return $this;
	}

	public function setCurrencyId($currency_id)
	{
		$this->currency_id = $currency_id;

		return $this;
	}

	public function setFacilities($facilities)
	{
		$this->facilities = $facilities;

		return $this;
	}

	public function setLandlordId($landlord_id)
	{
		$this->landlord_id = $landlord_id;

		return $this;
	}

	public function getId()
	{
		return $this->id;
	}

	
	public function getType()
	{
		return $this->type;
	}

	public function getLongitude()
	{
		return $this->longitude;
	}

	public function getLatitude()
	{
		return $this->latitude;
	}

	public function getEstateName()
	{
		return $this->estate_name;
	}

	public function getBlock()
	{
		return $this->block;
	}

	public function getFloor()
	{
		return $this->floor;
	}

	public function getHouseNo()
	{
		return $this->house_no;
	}

	public function getRentAmount()
	{
		return $this->rent_amount;
	}

	public function getCurrencyId()
	{
		return $this->currency_id;
	}

	public function getFacilities()
	{
		return $this->facilities;
	}

	public function getLandlordId()
	{
		return $this->landlord_id;
	}

	public function getSource()
	{
		return 'house';
	}

	public static function find($parameters = null)
	{
		return parent::find($parameters);
	}

	public static function findFirst($parameters = null)
	{
		return parent::findFirst($parameters);
	}
}
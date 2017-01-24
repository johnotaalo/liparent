<?php

namespace LIPARENT\Superadmin\Models;

class Tenant extends \Phalcon\Mvc\Model
{
	protected $id;

	protected $id_number;

	protected $first_name;

	protected $surname;

	protected $house_id;

	protected $user_id;
	

	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	public function setIdNumber($id_number)
	{
		$this->id_number = $id_number;

		return $this;
	}

	public function setFirstName($first_name)
	{
		$this->first_name = $first_name;

		return $this;
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;

		return $this;
	}

	public function setHouseId($house_id)
	{
		$this->house_id = $house_id;

		return $this;
	}

	public function setUserId($user_id)
	{
		$this->user_id = $user_id;

		return $this;
	}


	public function getId()
	{
		return $this->id;
	}

	public function getIdNumber()
	{
		return $this->id_number;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getSurName()
	{
		return $this->surname;
	}

	public function getHouseId()
	{
		return $this->house_id;
	}

	public function getUserid()
	{
		return $this->user_id;
	}

	public function getSource()
	{
		return 'tenant';
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
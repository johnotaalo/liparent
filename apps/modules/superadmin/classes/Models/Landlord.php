<?php

namespace LIPARENT\Superadmin\Models;

class Landlord extends \Phalcon\Mvc\Model
{
	protected $id;

	protected $user_id;

	protected $id_number;

	protected $surname;

	protected $first_name;

	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	public function setUserid($user_id)
	{
		$this->user_id = $user_id;

		return $this;
	}

	public function setIdnumber($id_number)
	{
		$this->id_number = $id_number;

		return $this;
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;

		return $this;
	}

	public function setFirstname($first_name)
	{
		$this->first_name = $first_name;

		return $this;
	}


	public function getId()
	{
		return $this->id;
	}

	public function getUserid()
	{
		return $this->user_id;
	}

	public function getIdnumber()
	{
		return $this->id_number;
	}

	public function getSurname()
	{
		return $this->surname;
	}

	public function getFirstname()
	{
		return $this->first_name;
	}


	public function getSource()
	{
		return 'landlord';
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
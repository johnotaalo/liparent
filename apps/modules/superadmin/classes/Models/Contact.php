<?php

namespace LIPARENT\Superadmin\Models;

class Contact extends \Phalcon\Mvc\Model
{
	protected $id;

	protected $user_id;

	protected $contact;

	protected $type;

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

	public function setContact($contact)
	{
		$this->contact = $contact;

		return $this;
	}

	public function setType($type)
	{
		$this->type = $type;

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

	public function getContact()
	{
		return $this->contact;
	}

	public function getType()
	{
		return $this->type;
	}


	public function getSource()
	{
		return 'contact';
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
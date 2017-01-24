<?php

namespace LIPARENT\Superadmin\Models;

class User extends \Phalcon\Mvc\Model
{
	protected $id;
	
	protected $username;

	protected $password;

	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	public function getId()
	{
		return $this->id;
	}

	
	public function getUsername()
	{
		return $this->username;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getSource()
	{
		return 'user';
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
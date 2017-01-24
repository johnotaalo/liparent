<?php

namespace LIPARENT\Superadmin\Models;

class UserGroup extends \Phalcon\Mvc\Model
{
	protected $id;

	protected $name;

	function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	function getId()
	{
		return $this->id;
	}

	function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	function getName()
	{
		return $this->name;
	}

	function getSource()
	{
		return "user_group";
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
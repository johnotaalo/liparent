<?php

namespace LIPARENT\Superadmin\Models;

class Currency extends \Phalcon\Mvc\Model
{

	protected $id;

	protected $name;


	public function getId()
	{
		return $this->id;
	}

	
	public function getname()
	{
		return $this->username;
	}


	public function getSource()
	{
		return 'currency';
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
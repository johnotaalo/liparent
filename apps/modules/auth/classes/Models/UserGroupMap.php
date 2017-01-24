<?php

namespace LIPARENT\Auth\Models;

class UserGroupMap extends \Phalcon\Mvc\Model
{
	protected $id;

	protected $user_id;

	protected $usergroup_id;

	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	public function setUserId($user_id)
	{
		$this->user_id = $user_id;

		return $this;
	}

	public function setUserGroupId($usergroup_id)
	{
		$this->usergroup_id = $usergroup_id;

		return $this;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getUserId()
	{
		return $this->user_id;
	}

	public function getUserGroupId()
	{
		return $this->usergroup_id;
	}

	public function getSource()
	{
		return 'user_usergroup_map';
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
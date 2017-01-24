<?php

namespace LIPARENT\Auth\Models;
use Phalcon\Mvc\Model\Query;
use Phalcon\Di;
use Phalcon\Mvc\Model\Manager as ModelsManager;

$di = new Di();

$di->set('modelsManager', function() {
  return new ModelsManager();
});

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

	public static function get_loggedin_landlord($user_id)
    {
        $di = \Phalcon\DI::getDefault();

        $db = $di->get('db');

        $sql     = "SELECT CONCAT(l.surname, ' ',  l.first_name) AS name
					FROM landlord l
					JOIN user u ON l.user_id = u.id
					WHERE u.id = {$user_id} ";
        // echo $sql;die;
        $result_set = $db->query($sql);
        $result_set->setFetchMode( \Phalcon\Db::FETCH_ASSOC );
        $result_set = $result_set->fetchAll($result_set);

        return $result_set;
    }

    public static function get_loggedin_tenant($user_id)
    {
        $di = \Phalcon\DI::getDefault();

        $db = $di->get('db');

        $sql     = "SELECT CONCAT(t.surname, ' ',  t.first_name) AS name
					FROM tenant t
					JOIN user u ON t.user_id = u.id
					WHERE u.id = {$user_id}";
        // echo $sql;die;
        $result_set = $db->query($sql);
        $result_set->setFetchMode( \Phalcon\Db::FETCH_ASSOC );
        $result_set = $result_set->fetchAll($result_set);

        return $result_set;
    }

    public static function get_loggedin_admin($user_id)
    {
        $di = \Phalcon\DI::getDefault();

        $db = $di->get('db');

        $sql     = "SELECT CONCAT(a.surname, ' ',  a.first_name) AS name
					FROM admin a
					JOIN user u ON a.user_id = u.id
					WHERE u.id = {$user_id}";
        // echo $sql;die;
        $result_set = $db->query($sql);
        $result_set->setFetchMode( \Phalcon\Db::FETCH_ASSOC );
        $result_set = $result_set->fetchAll($result_set);

        return $result_set;
    }

}
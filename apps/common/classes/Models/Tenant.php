<?php

namespace LIPARENT\Common\Models;

class Tenant extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $id_number;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $first_name;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $surname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $house_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $active;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field id_number
     *
     * @param integer $id_number
     * @return $this
     */
    public function setIdNumber($id_number)
    {
        $this->id_number = $id_number;

        return $this;
    }

    /**
     * Method to set the value of field first_name
     *
     * @param string $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Method to set the value of field surname
     *
     * @param string $surname
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Method to set the value of field house_id
     *
     * @param integer $house_id
     * @return $this
     */
    public function setHouseId($house_id)
    {
        $this->house_id = $house_id;

        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field active
     *
     * @param integer $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field id_number
     *
     * @return integer
     */
    public function getIdNumber()
    {
        return $this->id_number;
    }

    /**
     * Returns the value of field first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Returns the value of field surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Returns the value of field house_id
     *
     * @return integer
     */
    public function getHouseId()
    {
        return $this->house_id;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'LIPARENT\Common\Models\Complaint', 'tenant_id', ['alias' => 'Complaint']);
        $this->hasMany('id', 'LIPARENT\Common\Models\Defaulter', 'tenant_id', ['alias' => 'Defaulter']);
        $this->hasMany('id', 'LIPARENT\Common\Models\Payment', 'tenant_id', ['alias' => 'Payment']);
        $this->belongsTo('house_id', 'LIPARENT\Common\Models\House', 'id', ['alias' => 'House']);
        $this->belongsTo('user_id', 'LIPARENT\Common\Models\User', 'id', ['alias' => 'User']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tenant';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tenant[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tenant
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

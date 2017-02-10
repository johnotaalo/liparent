<?php

namespace LIPARENT\Common\Models;

class UserView extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $user_active;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $user_group;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $emailaddress;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $created;

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
     * Method to set the value of field user_active
     *
     * @param integer $user_active
     * @return $this
     */
    public function setUserActive($user_active)
    {
        $this->user_active = $user_active;

        return $this;
    }

    /**
     * Method to set the value of field user_group
     *
     * @param string $user_group
     * @return $this
     */
    public function setUserGroup($user_group)
    {
        $this->user_group = $user_group;

        return $this;
    }

    /**
     * Method to set the value of field emailaddress
     *
     * @param string $emailaddress
     * @return $this
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;

        return $this;
    }

    /**
     * Method to set the value of field created
     *
     * @param string $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
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
     * Returns the value of field user_active
     *
     * @return integer
     */
    public function getUserActive()
    {
        return $this->user_active;
    }

    /**
     * Returns the value of field user_group
     *
     * @return string
     */
    public function getUserGroup()
    {
        return $this->user_group;
    }

    /**
     * Returns the value of field emailaddress
     *
     * @return string
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * Returns the value of field created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_view';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserView[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserView
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

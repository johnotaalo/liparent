<?php

namespace LIPARENT\Common\Models;

class TenantHouseV extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $tenant_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $tenant_id_number;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $tenant_first_name;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $tenant_surname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $tenant_active;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $tenant_user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $house_id;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $house_longitude;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $house_latitude;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $house_estatename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $house_block;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $house_floor;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
     */
    protected $house_no;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $house_rent_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $house_currency;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $facilities;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $landlord_id;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $landlord_firstname;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $landlord_lastname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $availability;

    /**
     * Method to set the value of field tenant_id
     *
     * @param integer $tenant_id
     * @return $this
     */
    public function setTenantId($tenant_id)
    {
        $this->tenant_id = $tenant_id;

        return $this;
    }

    /**
     * Method to set the value of field tenant_id_number
     *
     * @param integer $tenant_id_number
     * @return $this
     */
    public function setTenantIdNumber($tenant_id_number)
    {
        $this->tenant_id_number = $tenant_id_number;

        return $this;
    }

    /**
     * Method to set the value of field tenant_first_name
     *
     * @param string $tenant_first_name
     * @return $this
     */
    public function setTenantFirstName($tenant_first_name)
    {
        $this->tenant_first_name = $tenant_first_name;

        return $this;
    }

    /**
     * Method to set the value of field tenant_surname
     *
     * @param string $tenant_surname
     * @return $this
     */
    public function setTenantSurname($tenant_surname)
    {
        $this->tenant_surname = $tenant_surname;

        return $this;
    }

    /**
     * Method to set the value of field tenant_active
     *
     * @param integer $tenant_active
     * @return $this
     */
    public function setTenantActive($tenant_active)
    {
        $this->tenant_active = $tenant_active;

        return $this;
    }

    /**
     * Method to set the value of field tenant_user_id
     *
     * @param integer $tenant_user_id
     * @return $this
     */
    public function setTenantUserId($tenant_user_id)
    {
        $this->tenant_user_id = $tenant_user_id;

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
     * Method to set the value of field house_longitude
     *
     * @param string $house_longitude
     * @return $this
     */
    public function setHouseLongitude($house_longitude)
    {
        $this->house_longitude = $house_longitude;

        return $this;
    }

    /**
     * Method to set the value of field house_latitude
     *
     * @param string $house_latitude
     * @return $this
     */
    public function setHouseLatitude($house_latitude)
    {
        $this->house_latitude = $house_latitude;

        return $this;
    }

    /**
     * Method to set the value of field house_estatename
     *
     * @param string $house_estatename
     * @return $this
     */
    public function setHouseEstatename($house_estatename)
    {
        $this->house_estatename = $house_estatename;

        return $this;
    }

    /**
     * Method to set the value of field house_block
     *
     * @param integer $house_block
     * @return $this
     */
    public function setHouseBlock($house_block)
    {
        $this->house_block = $house_block;

        return $this;
    }

    /**
     * Method to set the value of field house_floor
     *
     * @param integer $house_floor
     * @return $this
     */
    public function setHouseFloor($house_floor)
    {
        $this->house_floor = $house_floor;

        return $this;
    }

    /**
     * Method to set the value of field house_no
     *
     * @param string $house_no
     * @return $this
     */
    public function setHouseNo($house_no)
    {
        $this->house_no = $house_no;

        return $this;
    }

    /**
     * Method to set the value of field house_rent_amount
     *
     * @param string $house_rent_amount
     * @return $this
     */
    public function setHouseRentAmount($house_rent_amount)
    {
        $this->house_rent_amount = $house_rent_amount;

        return $this;
    }

    /**
     * Method to set the value of field house_currency
     *
     * @param string $house_currency
     * @return $this
     */
    public function setHouseCurrency($house_currency)
    {
        $this->house_currency = $house_currency;

        return $this;
    }

    /**
     * Method to set the value of field facilities
     *
     * @param string $facilities
     * @return $this
     */
    public function setFacilities($facilities)
    {
        $this->facilities = $facilities;

        return $this;
    }

    /**
     * Method to set the value of field landlord_id
     *
     * @param integer $landlord_id
     * @return $this
     */
    public function setLandlordId($landlord_id)
    {
        $this->landlord_id = $landlord_id;

        return $this;
    }

    /**
     * Method to set the value of field landlord_firstname
     *
     * @param string $landlord_firstname
     * @return $this
     */
    public function setLandlordFirstname($landlord_firstname)
    {
        $this->landlord_firstname = $landlord_firstname;

        return $this;
    }

    /**
     * Method to set the value of field landlord_lastname
     *
     * @param string $landlord_lastname
     * @return $this
     */
    public function setLandlordLastname($landlord_lastname)
    {
        $this->landlord_lastname = $landlord_lastname;

        return $this;
    }

    /**
     * Method to set the value of field availability
     *
     * @param integer $availability
     * @return $this
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Returns the value of field tenant_id
     *
     * @return integer
     */
    public function getTenantId()
    {
        return $this->tenant_id;
    }

    /**
     * Returns the value of field tenant_id_number
     *
     * @return integer
     */
    public function getTenantIdNumber()
    {
        return $this->tenant_id_number;
    }

    /**
     * Returns the value of field tenant_first_name
     *
     * @return string
     */
    public function getTenantFirstName()
    {
        return $this->tenant_first_name;
    }

    /**
     * Returns the value of field tenant_surname
     *
     * @return string
     */
    public function getTenantSurname()
    {
        return $this->tenant_surname;
    }

    /**
     * Returns the value of field tenant_active
     *
     * @return integer
     */
    public function getTenantActive()
    {
        return $this->tenant_active;
    }

    /**
     * Returns the value of field tenant_user_id
     *
     * @return integer
     */
    public function getTenantUserId()
    {
        return $this->tenant_user_id;
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
     * Returns the value of field house_longitude
     *
     * @return string
     */
    public function getHouseLongitude()
    {
        return $this->house_longitude;
    }

    /**
     * Returns the value of field house_latitude
     *
     * @return string
     */
    public function getHouseLatitude()
    {
        return $this->house_latitude;
    }

    /**
     * Returns the value of field house_estatename
     *
     * @return string
     */
    public function getHouseEstatename()
    {
        return $this->house_estatename;
    }

    /**
     * Returns the value of field house_block
     *
     * @return integer
     */
    public function getHouseBlock()
    {
        return $this->house_block;
    }

    /**
     * Returns the value of field house_floor
     *
     * @return integer
     */
    public function getHouseFloor()
    {
        return $this->house_floor;
    }

    /**
     * Returns the value of field house_no
     *
     * @return string
     */
    public function getHouseNo()
    {
        return $this->house_no;
    }

    /**
     * Returns the value of field house_rent_amount
     *
     * @return string
     */
    public function getHouseRentAmount()
    {
        return $this->house_rent_amount;
    }

    /**
     * Returns the value of field house_currency
     *
     * @return string
     */
    public function getHouseCurrency()
    {
        return $this->house_currency;
    }

    /**
     * Returns the value of field facilities
     *
     * @return string
     */
    public function getFacilities()
    {
        return $this->facilities;
    }

    /**
     * Returns the value of field landlord_id
     *
     * @return integer
     */
    public function getLandlordId()
    {
        return $this->landlord_id;
    }

    /**
     * Returns the value of field landlord_firstname
     *
     * @return string
     */
    public function getLandlordFirstname()
    {
        return $this->landlord_firstname;
    }

    /**
     * Returns the value of field landlord_lastname
     *
     * @return string
     */
    public function getLandlordLastname()
    {
        return $this->landlord_lastname;
    }

    /**
     * Returns the value of field availability
     *
     * @return integer
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TenantHouseV[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TenantHouseV
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tenant_house_v';
    }

}

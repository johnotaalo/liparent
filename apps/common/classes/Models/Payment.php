<?php

namespace LIPARENT\Common\Models;

class Payment extends \Phalcon\Mvc\Model
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
    protected $tenant_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $period_from;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $period_to;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $transaction_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $verified;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $amount;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $date;

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
     * Method to set the value of field period_from
     *
     * @param string $period_from
     * @return $this
     */
    public function setPeriodFrom($period_from)
    {
        $this->period_from = $period_from;

        return $this;
    }

    /**
     * Method to set the value of field period_to
     *
     * @param string $period_to
     * @return $this
     */
    public function setPeriodTo($period_to)
    {
        $this->period_to = $period_to;

        return $this;
    }

    /**
     * Method to set the value of field transaction_code
     *
     * @param string $transaction_code
     * @return $this
     */
    public function setTransactionCode($transaction_code)
    {
        $this->transaction_code = $transaction_code;

        return $this;
    }

    /**
     * Method to set the value of field verified
     *
     * @param integer $verified
     * @return $this
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Method to set the value of field amount
     *
     * @param string $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Method to set the value of field date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

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
     * Returns the value of field tenant_id
     *
     * @return integer
     */
    public function getTenantId()
    {
        return $this->tenant_id;
    }

    /**
     * Returns the value of field period_from
     *
     * @return string
     */
    public function getPeriodFrom()
    {
        return $this->period_from;
    }

    /**
     * Returns the value of field period_to
     *
     * @return string
     */
    public function getPeriodTo()
    {
        return $this->period_to;
    }

    /**
     * Returns the value of field transaction_code
     *
     * @return string
     */
    public function getTransactionCode()
    {
        return $this->transaction_code;
    }

    /**
     * Returns the value of field verified
     *
     * @return integer
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Returns the value of field amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns the value of field date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('tenant_id', 'LIPARENT\Common\Models\Tenant', 'id', ['alias' => 'Tenant']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'payment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Payment[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Payment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
